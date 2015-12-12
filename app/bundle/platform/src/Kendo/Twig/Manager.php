<?php
namespace Kendo\Twig;

use Platform\Feed\Model\Feed;
use Kendo\Content\PosterInterface;

class Manager
{

    /**
     * @var \Twig_Environment
     */
    private $env;

    /**
     * @return \Twig_Environment
     */
    public function getEnv()
    {
        if (null == $this->env) {
            $this->env = new \Twig_Environment(new MailLoader(), [
                'autoescape' => false,
                'debug'      => false,
                'cache'      => false,
                'charset'    => 'utf-8',
            ]);

            $this->env->addFunction(new \Twig_SimpleFunction('link_cardhover', function ($item) {
                return strtr('<a href=":href" class="profile" data-hover="card" data-card=":card">:title</a>', [
                    ':href'  => $item->toHref(),
                    ':title' => $item->getTitle(),
                    ':card'  => $item->toToken(),
                ]);
            }));

            $this->env->addFunction(new \Twig_SimpleFunction('feed_context', function (Feed $item) {
                $profile = \App::registryService()->get('profile');

                if ($profile && $profile instanceof PosterInterface) {
                    $isMainFeed = \App::registryService()->get('isMainFeed');

                    if ($isMainFeed && $item->getParentId() == $item->getPosterId()) return '';

                    if ($item->getParentId() != $profile->getId()) {
                        $parent = $item->getParent();

                        return ' &raquo; ' . strtr('<a href=":href" data-hover="card" data-card=":card" class=":cls">:title</a>', [
                            ':href'  => $parent->toHref(),
                            ':cls'   => 'profile',
                            ':card'  => $parent->toToken(),
                            ':title' => $parent->getTitle(),
                        ]);
                    }
                }

                return '';
            }));
        }

        return $this->env;
    }

    /**
     * @param \Twig_Environment $env
     */
    public function setEnv($env)
    {
        $this->env = $env;
    }

    /**
     * @param string $msg
     * @param array  $context
     * @param null   $count
     *
     * @return string
     * @throws \Exception
     */
    public function renderHeadline($msg, $context = [], $count = null)
    {

        $msg = \App::trans()->msgId($msg, $count);

        return $this->getEnv()->createTemplate($msg)->render($context);
    }

}