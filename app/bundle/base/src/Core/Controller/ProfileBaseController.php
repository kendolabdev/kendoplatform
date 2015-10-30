<?php
namespace Core\Controller;

use Picaso\Controller\DefaultController;

/**
 * Class ProfileBaseController
 *
 * @package Core\Controller
 */
class ProfileBaseController extends DefaultController
{
    /**
     * Profile page
     */
    public function actionIndex()
    {
        /**
         * based on profile type, we might have the difference correcting table.
         */
        return $this->forward('\Feed\Controller\ProfileController', 'timeline');
    }

    /**
     *
     */
    protected function init()
    {
        parent::init();

        $profile = \App::registry()->get('profile');

        list($profileType, $profileId) = $this->request->get('profileType', 'profileId');

        if (empty($profile) && empty($profileType)) {
            $profile = \App::auth()->getViewer();
            \App::registry()->set('profile', $profile);
        }

        if (null == $profile) {
            /**
             * check is numeric
             */
            if (preg_match('#^(\d+)$#', $profileId)) {
                $profile = \App::find($profileType, $profileId);
            } else {
                $profile = \App::db()->getTable($profileType)
                    ->select()
                    ->where('profile_name=?', (string)$profileId)
                    ->one();
            }
            \App::registry()->set('profile', $profile);
        }

        /**
         *
         */
        $actionName = preg_replace('#\W+#m', '_', strtolower($this->request->getActionName()));

        \App::assets()
            ->setTitle($profile->getTitle());

        \App::layout()
            ->setPageName($profile->getType() . '_profile_' . $actionName);
    }

}