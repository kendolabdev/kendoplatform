<?php
namespace Platform\Place\Service;

use Kendo\Kernel\KernelService;
use Platform\Place\Model\Place;

/**
 * Class PlaceService
 *
 * @package Place\Service
 */
class PlaceService extends KernelService
{
    /**
     * @param $data
     *
     * @return Place
     */
    public function tryPlace($data)
    {
        if (empty($data)) {
            return null;
        }

        if (empty($data['google_place_id'])) {
            return null;
        }

        $place = $this->findByGoogleId($data['google_place_id']);

        if ($place instanceof Place) {
            return $place;
        }


        if (empty($data['address']) || empty($data['title']) || empty($data['lat']) || empty($data['lng'])) {
            return null;
        }

        return $this->addNulledPlace($data);
    }

    /**
     * @param string $googleId
     *
     * @return Place
     */
    public function findByGoogleId($googleId)
    {
        return app()->table('place')
            ->select()
            ->where('google_id=?', (string)$googleId)
            ->one();
    }

    /**
     * @param array $data
     *
     * @return Place
     */
    public function addNulledPlace($data)
    {
        $place = new Place([
            'google_id'      => $data['google_place_id'],
            'latitude'       => $data['lat'],
            'longitude'      => $data['lng'],
            'name'           => $data['title'],
            'address'        => $data['address'],
            'poster_id'      => 0,
            'parent_id'      => 0,
            'privacy_type'   => 1,
            'privacy_value'  => 1,
            'poster_type'    => '',
            'parent_type'    => '',
            'user_id'        => 0,
            'parent_user_id' => 0,
            'created_at'     => KENDO_DATE_TIME,
            'modified_at'    => KENDO_DATE_TIME
        ]);

        $place->save();

        return $place;
    }
}