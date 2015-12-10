<?php
namespace Base\Link\Service;

use Base\Feed\Model\Feed;
use Base\Link\Model\Link;
use Kendo\Content\PosterInterface;
use Kendo\Request\HttpRequest;

/**
 * Class Base\LinkService
 *
 * @package Base\Link\Service
 */
class LinkService
{
    /**
     * @param string $url
     *
     * @return array
     */
    public function parseEmbedly($url)
    {
        $endpoint = strtr('http://api.embed.ly/1/oembed?key=:key&url=:url', [
            ':key' => '0826bf674b954c1b8cdc1db03e2ca823',
            ':url' => $url,
        ]);

        $content = $this->fetchUrl($endpoint);

        if (!$content) {
            return false;
        }

        $info = parse_url($url);

        $response = json_decode($content, true);

        if (!$response) {
            return false;
        }

        if (empty($response['title']) || empty($response['type'])) {
            return false;
        }

        $response = [
            'title'         => trim($response['title'], '"'),
            'description'   => trim($response['description'], '"'),
            'provider_name' => $info['host'],
            'origin_url'    => $url,
            'link_type'     => $response['type'],
            'thumbnail_url' => $response['thumbnail_url']
        ];

        return $response;
    }

    /**
     * @param $url
     *
     * @return string
     */
    public function fetchUrl($url)
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept-Language: en,vi;q=0.8,en-US;q=0.6,fr;q=0.4,fr-FR;q=0.2,es;q=0.2',
            'User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36',
            'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        ]);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 5);

        $response = curl_exec($ch);

        return (string)$response;
    }

    /**
     * @param string $url
     *
     * @return array
     */
    public function parseUrl($url)
    {
        $charset = 'UTF-8';
        $sContent = $this->fetchUrl($url);

        if (empty($sContent)) {
            return false;
        }

        $aParts = parse_url($url);

        $aReturn = [
            'link_type'     => 'link',
            'origin_url'    => $url,
            'title'         => '',
            'description'   => '',
            'thumbnail_url' => '',
            'provider_name' => $aParts['host'],
            'images'        => [],
        ];


        $sContent = trim($sContent);

        if (function_exists('mb_convert_encoding')) {
            $sContent = mb_convert_encoding($sContent, 'HTML-ENTITIES', $charset);
        }

        preg_match_all('/<(meta|link)(.*?)>/i', $sContent, $aRegMatches);

        if (isset($aRegMatches[2])) {
            foreach ($aRegMatches as $iKey => $aMatch) {
                if ($iKey !== 2) {
                    continue;
                }

                foreach ($aMatch as $sLine) {
                    $sLine = rtrim($sLine, '/');
                    $sLine = trim($sLine);

                    preg_match('/(property|name|rel)=("|\')(.*?)("|\')/ise', $sLine, $aType);
                    if (count($aType) && isset($aType[3])) {
                        $sType = $aType[3];
                        preg_match('/(content|type)=("|\')(.*?)("|\')/i', $sLine, $aValue);
                        if (count($aValue) && isset($aValue[3])) {
                            if ($sType == 'alternate') {
                                $sType = $aValue[3];
                                preg_match('/href=("|\')(.*?)("|\')/i', $sLine, $aHref);
                                if (isset($aHref[2])) {
                                    $aValue[3] = $aHref[2];
                                }
                            }
                            $aParseBuild[ $sType ] = $aValue[3];
                        }
                    }
                }
            }

            if (isset($aParseBuild['og:title'])) {
                $aReturn['title'] = $aParseBuild['og:title'];
                $aReturn['description'] = (isset($aParseBuild['og:description']) ? $aParseBuild['og:description'] : '');
                $aReturn['thumbnail_url'] = (isset($aParseBuild['og:image']) ? $aParseBuild['og:image'] : '');

                return $aReturn;
            }
        }

        $oDoc = new \DOMDocument();
        $oDoc->loadHTML($sContent);

        if (($oTitle = $oDoc->getElementsByTagName('title')->item(0)) && !empty($oTitle->nodeValue)) {
            $aReturn['title'] = strip_tags($oTitle->nodeValue);
        }

        if (empty($aReturn['title'])) {
            if (preg_match('/^(.*?)\.(jpg|png|jpeg|gif)$/i', $url, $aImageMatches)) {

                $aReturn['link_type'] = 'image';
                $aReturn['thumbnail_url'] = $url;

                return $aReturn;
            }
        }

        $oXpath = new \DOMXPath($oDoc);

        $oMeta = $oXpath->query("//meta[@name='description']")->item(0);
        if (method_exists($oMeta, 'getAttribute')) {
            $sMeta = $oMeta->getAttribute('content');
            if (!empty($sMeta)) {
                $aReturn['description'] = strip_tags($sMeta);
            }
        }

        $aImages = [];
        $oMeta = $oXpath->query("//meta[@property='og:image']")->item(0);
        if (method_exists($oMeta, 'getAttribute')) {
            $aReturn['thumbnail_url'] = strip_tags($oMeta->getAttribute('content'));
            $aImages[] = strip_tags($oMeta->getAttribute('content'));
        }

        $oMeta = $oXpath->query("//link[@rel='image_src']")->item(0);
        if (method_exists($oMeta, 'getAttribute')) {
            if (empty($aReturn['thumbnail_url'])) {
                $aReturn['thumbnail_url'] = strip_tags($oMeta->getAttribute('href'));
            }
            $aImages[] = strip_tags($oMeta->getAttribute('href'));
        }

        if (!isset($aReturn['thumbnail_url'])) {
            $oMeta = $oXpath->query("//meta[@itemprop='image']")->item(0);
            if (method_exists($oMeta, 'getAttribute')) {
                $aReturn['thumbnail_url'] = strip_tags($oMeta->getAttribute('content'));
                if (strpos($aReturn['thumbnail_url'], $url) === false) {
                    $aReturn['thumbnail_url'] = $url . '/' . $aReturn['thumbnail_url'];
                }
            }
        }


        if (!empty($aReturn['thumbnail_url'])) {
            $oImages = $oDoc->getElementsByTagName('img');
            $iIteration = 0;
            foreach ($oImages as $oImage) {

                if (!$oImage instanceof \DOMElement) ;

                $sImageSrc = $oImage->getAttribute('src');

                if (substr($sImageSrc, 0, 7) != 'http://' && substr($sImageSrc, 0, 1) != '/') {
                    continue;
                }

                if (substr($sImageSrc, 0, 2) == '//') {
                    continue;
                }

                $iIteration++;

                if (substr($sImageSrc, 0, 1) == '/') {
                    $sImageSrc = 'http://' . $aParts['host'] . $sImageSrc;
                }

                if ($iIteration === 1 && empty($aReturn['thumbnail_url'])) {
                    $aReturn['thumbnail_url'] = strip_tags($sImageSrc);
                }

                if ($iIteration > 10) {
                    break;
                }

                $aImages[] = strip_tags($sImageSrc);
            }
        }

        if (count($aImages)) {
            $aReturn['images'] = $aImages;
        }

        return $aReturn;

    }

    /**
     * @param                 $params
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     * @param int             $privacyType
     * @param int             $privacyValue
     *
     * @return \Base\Link\Model\Link
     */
    public function addLink($params, PosterInterface $poster, PosterInterface $parent, $privacyType, $privacyValue)
    {

        if (null === $privacyType || null == $privacyValue) {
            $privacyType = RELATION_TYPE_ANYONE;
            $privacyValue = RELATION_TYPE_ANYONE;
        }

        $data = array_merge([
            'poster_id'     => $poster->getId(),
            'parent_id'     => $parent->getId(),
            'poster_type'   => $poster->getType(),
            'parent_type'   => $parent->getType(),
            'user_id'       => $poster->getUserId(),
            'privacy_type'  => $privacyType,
            'privacy_value' => $privacyValue,
            'created_at'    => KENDO_DATE_TIME,
            'modified_at'   => KENDO_DATE_TIME,
            'privacy_text'  => json_encode(['view' => ['type' => $privacyType, 'value' => $privacyType]])
        ], $params);

        $link = new Link($data);

        $link->save();

        return $link;
    }

    /**
     * @param HttpRequest     $request
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     *
     * @return Feed
     */
    public function addFromCommentComposer(HttpRequest $request, PosterInterface $poster, PosterInterface $parent)
    {
        $privacy = $request->getArray('privacy');

        $privacyType = 1;
        $privacyValue = 1;

        if (!empty($privacy)) {
            $privacyType = $privacy['type'];
            $privacyValue = $privacy['value'];
        }

        $data = $request->getArray('link');

        $link = $this->addLink($data, $poster, $parent, $privacyType, $privacyValue);

        return $link;
    }

    /**
     * @param HttpRequest     $request
     * @param PosterInterface $poster
     * @param PosterInterface $parent
     *
     * @return Feed
     */
    public function addFromActivityComposer(HttpRequest $request, PosterInterface $poster, PosterInterface $parent)
    {
        $privacy = $request->getArray('privacy');

        $privacyType = 1;
        $privacyValue = 1;

        if (!empty($privacy)) {
            $privacyType = $privacy['type'];
            $privacyValue = $privacy['value'];
        }
        $story = $request->getString('statusTxt');

        $data = $request->getArray('link');

        $data['story'] = $story;

        $link = $this->addLink($data, $poster, $parent, $privacyType, $privacyValue);

        $needUpdate = false;

        $place = $request->getArray('place');

        if (!empty($place)) {
            $link->setPlace($place);
            $needUpdate = true;
        }

        $people = $request->getArray('people');

        if (!empty($people)) {
            $link->setPeople($people);
            $needUpdate = true;
        }

        if ($needUpdate) {
            $link->save();
        }
        $feed = \App::feedService()->addItemFeed('update_status', $link);

        return $feed;
    }
}