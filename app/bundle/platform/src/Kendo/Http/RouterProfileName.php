<?php
namespace Kendo\Http;

/**
 * Class RouterProfileName
 *
 * @package Kendo\Http
 */
class RouterProfileName extends Router
{
    /**
     * @param \Kendo\Http\RoutingResult $result
     *
     * @return bool
     * @throws \Exception
     */
    protected function filter(RoutingResult $result)
    {
        $content = \App::emitter()
            ->emit('onFilterProfileNameRun', $result);

        $data = null;

        foreach ($content->getResponse() as $data) {
            break;
        }

        if (!is_array($data)) {
            return false;
        }

        if (empty($data['profileType']))
            return false;

        if (empty($data['profileId']))
            return false;

        $result->setVars($data);

        return true;
    }
}