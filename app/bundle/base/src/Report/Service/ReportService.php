<?php

namespace Report\Service;

use Picaso\Content\Poster;
use Report\Model\Report;
use Report\Model\ReportCategory;
use Report\Model\ReportGeneral;

/**
 * Class ReportService
 *
 * @package Report\Service
 */
class ReportService
{

    /**
     * @return array
     */
    public function loadCategoryOptions()
    {
        return \App::cache()
            ->get(['report', 'loadCateoryOptions', ''], 0, function () {
                return $this->_loadCategoryOptions();
            });
    }

    /**
     * @return array
     */
    public function _loadCategoryOptions()
    {
        $select = \App::table('report.report_category')
            ->select()
            ->order('category_name', 1);

        $items = $select->all();

        $options = [];

        foreach ($items as $item) {
            if (!$item instanceof ReportCategory) continue;
            $options[] = [
                'value' => $item->getId(),
                'label' => $item->getTitle(),
            ];
        }

        return $options;
    }

    /**
     * @param string|int $id
     *
     * @return \Report\Model\ReportCategory
     */
    public function findCategoryById($id)
    {
        return \App::table('report.report_category')
            ->findById(intval($id));
    }

    /**
     * Require params "category_name"
     *
     * @param array $data
     *
     * @return \Report\Model\ReportCategory
     */
    public function addCategory($data)
    {
        if (empty($data['category_name']))
            throw new \InvalidArgumentException("Missing parameters [category_name]");

        $entry = new ReportCategory($data);

        $entry->save();

        return $entry;
    }

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Picaso\Paging\PagingInterface
     */
    public function loadAdminCategoryPaging($query = [], $page = 1, $limit = 100)
    {
        $select = \App::table('report.report_category')->select();

        if (!empty($query)) ;

        return $select->paging($page, $limit);
    }

    /**
     * Load paging general report
     *
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Picaso\Paging\PagingInterface
     */
    public function loadAdminGeneralReportPaging($query = [], $page = 1, $limit = 10)
    {
        $select = \App::table('report.report_general')
            ->select();

        if (!empty($query))
            ;

        return $select->paging($page, $limit);
    }

    /**
     * Load paging report about items
     *
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Picaso\Paging\PagingInterface
     */
    public function loadAdminReportPaging($query = [], $page = 1, $limit = 10)
    {
        $select = \App::table('report')
            ->select();

        if (!empty($query['aboutType'])) {
            $select->where('about_type=?', (string)$query['aboutType']);
        }
        if (!empty($query['category'])) {
            $select->where('category_id=?', (string)$query['category']);
        }


        return $select->paging($page, $limit);
    }

    /**
     * @param Poster $poster
     * @param string $message
     * @param array  $params
     *
     * @return ReportGeneral
     */
    public function addGeneralReport(Poster $poster, $message, $params = [])
    {
        $data = array_merge([
            'poster_type' => $poster->getType(),
            'poster_id'   => $poster->getId(),
            'message'     => (string)$message,
            'created_at'  => PICASO_DATE_TIME,
        ], $params);

        $report = new ReportGeneral($data);

        $report->save();

        return $report;
    }


    /**
     * @param \Picaso\Content\Poster                         $poster
     * @param \Picaso\Content\Content|\Picaso\Content\Poster $about
     * @param array                                          $data
     *
     * @return Report
     */
    public function addReport($poster, $about, $data = [])
    {

        $data = array_merge([
            'poster_id'   => $poster->getId(),
            'poster_type' => $poster->getType(),
            'about_type'  => $about->getType(),
            'about_id'    => $about->getId(),
            'created_at'  => PICASO_DATE_TIME,
        ], $data);

        /**
         *
         */
        $item = new Report($data);

        $item->save();

        return $item;
    }
}
