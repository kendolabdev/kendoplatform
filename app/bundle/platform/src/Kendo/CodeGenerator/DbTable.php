<?php

namespace Kendo\CodeGenerator;

/**
 * Class DbTable
 *
 * @package Kendo\CodeGenerator
 */
class DbTable
{

    const PREPARE_FOR_REPLACMENT = '//[PREPARE_FOR_REPLACMENT]';

    /**
     * @var bool
     */
    private $testOnly = false;

    /**
     * @var string
     */
    private $tableGetPrimary = '
    /**
     * @return array
     */
    public function getPrimary(){
        return :primaryArray;
    }
    ';

    /**
     * @var string
     */
    private $tableGetColumnNotPrimary = '
    /**
     * @return array
     */
    public function getColumnsNotPrimary(){
        return :columnsNotPrimary;
    }
    ';

    /**
     * @var string
     */
    private $tableGetPrimaryNull = '
    /**
     * @return array
     */
    public function getPrimary(){
        return array();
    }
    ';


    /**
     * @var string
     */
    private $tableGetColumn = '
    /**
     * @return string
     */
    public function getColumns(){
        return :columnArray;
    }
    ';


    private $tableFindById = '
    /**
     * @param  string|int $value
     * @return :fullModelClass
     */
    public function findById($value){
       return $this->select()
           ->where(\':primaryColumn=?\', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where(\':primaryColumn IN ?\', $value)
           ->all();
    }';

    private $tableFindByIdNull = '
    /**
     * @param  string|int $value
     * @return null
     * @throws \Kendo\Db\Exception
     */
    public function findById($value){
       throw new \Kendo\Db\Exception(\'Can not find by id for \'.$value);
    }';

    private $modelGetter = '
    /**
     * @return null|string
     */
    public function :getterName(){
       return $this->__get(\':columnName\');
    }';

    private $modelSetter = '
    /**
     * @param $value
     */
    public function :setterName($value){
       $this->__set(\':columnName\', $value);
    }';

    /**
     * @var string
     */
    private $modelFrame = '<?php
/**
 * Generate by CodeGenerator\DbTable for table `:fullTableName`
 */

namespace :modelNamespace;

/**
 */
use Kendo\Model;

/**
 * Class :modelClass
 * @package :modelNamespace
 */
class :modelClass extends Model{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    //END_TABLE_GENERATOR
}';

    private $modelContent = '//START_TABLE_GENERATOR

    :modelMethods

    /**
     * @return :fullTableClass
     */
    public function table(){
        return app()->table(\':tableAlias\');
    }
    //END_TABLE_GENERATOR';

    /**
     * @var string
     */
    private $tableFrame = '<?php
/**
 * Generate by CodeGenerator\DbTable for table `:fullTableName`
 */

namespace :modelNamespace;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class :tableClass
 * @package :modelNamespace
 */
class :tableClass extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    //END_TABLE_GENERATOR
}';

    /**
     * @var string
     */
    private $tableContent = '//START_TABLE_GENERATOR

    /**
     * @see `:fullTableName`
     * @var string
     */
    protected $class =  \':fullModelClass\';

    /**
     * @var string
     */
    protected $name =  \':shortenTableName\';

    /**
     * @var array
     */
    protected $column = :columnArray;

    /**
     * @var array
     */
    protected $primary = :primaryArray;

    /**
     * @var string
     */
    protected $identity = \':identityString\';

    :tableMethods

    //END_TABLE_GENERATOR';

    /**
     * @return boolean
     */
    public function isTestOnly()
    {
        return $this->testOnly;
    }

    /**
     * @param boolean $testOnly
     */
    public function setTestOnly($testOnly)
    {
        $this->testOnly = $testOnly;
    }


    /**
     * @param $table
     *
     * @return mixed|null|string
     * @throws \Exception
     */
    public function generate($table)
    {

        $shortenTableName = $this->getShortenTableName($table);

        if (null == $shortenTableName) {
            return null;
        }

        $metadata = $this->getMetadata($table);


        $parse = explode('_', $table, 4);

        if (count($parse) < 3) {
            echo "Do not processs: " . $table, PHP_EOL;

            return false;
        };

        $vendor = $parse[1];
        $module = $parse[2];


        $tail = null;
        $tableAlias = $shortenTableName;
        if (count($parse) > 3) {
            $tail = $parse[3];
        }


        $modelNamespace = $this->getModelNamespace($vendor, $module);
        $modelClass = $this->getModelClass($vendor, $module, $shortenTableName);
        $tableClass = $this->getTableClass($vendor, $module, $shortenTableName);


        $fullModelClass = "\\{$modelNamespace}\\{$modelClass}";
        $fullTableClass = "\\{$modelNamespace}\\{$tableClass}";


        $vars = [
            ':tableAlias'        => $tableAlias,
            ':modelClass'        => $modelClass,
            ':shortenTableName'  => $shortenTableName,
            ':columnArray'       => $this->generateExportArray($metadata['column']),
            ':primaryArray'      => $this->generateExportArray($metadata['primary'], ' '),
            ':columnsNotPrimary' => $this->generateExportArray(array_diff_key($metadata['column'], $metadata['primary'])),
            ':identityString'    => $metadata['identity'],
            ':tableClass'        => $tableClass,
            ':modelNamespace'    => $modelNamespace,
            ':fullModelClass'    => $fullModelClass,
            ':fullTableClass'    => $fullTableClass,
            ':fullTableName'     => $table,
        ];

        $vars[':modelMethods'] = $this->generateModelMethods($metadata, $vars);
        $vars[':tableMethods'] = $this->generateTableMethods($metadata, $vars);


        // generate table class content
        $tableFrameString = null;
        $tableContentString = strtr($this->tableContent, $vars);

        $tablePath = app()->autoload()->getPath($fullTableClass);

        if (!$tablePath)
            throw new \InvalidArgumentException("namespace for $tablePath does not exists");


        if (file_exists($tablePath)) {
            $tableFrameString = file_get_contents($tablePath);
        } else {
            $tableFrameString = strtr($this->tableFrame, $vars);
        }

        $tableFrameString = str_replace(self::PREPARE_FOR_REPLACMENT, $tableContentString, $this->prepareForReplaceTable($tableFrameString, $tableClass));

        file_put_contents($tablePath, $tableFrameString);

        // generate for model class
        $modelPath = app()->autoload()->getPath($fullModelClass);

        if (!$modelPath)
            throw new \InvalidArgumentException("namespace for $modelPath does not exists");


        // generate table class content
        $modelFrameString = null;
        $modelContentString = strtr($this->modelContent, $vars);


        if (file_exists($modelPath)) {
            $modelFrameString = file_get_contents($modelPath);
        } else {
            $modelFrameString = strtr($this->modelFrame, $vars);
        }

        $modelFrameString = str_replace(self::PREPARE_FOR_REPLACMENT, $modelContentString, $this->prepareForReplaceTable($modelFrameString, $modelClass));

        app()->table('platform_core_type')
            ->insertIgnore([
                'type_id'               => $tableAlias,
                'table_name'            => $fullTableClass,
                'module_name'           => strtolower($vendor . '_' . $module),
                'is_poster'             => 0,
                'has_attribute_catalog' => 0,
            ]);

        /**
         * @codeCoverageIgnoreStart
         */
        if (false == $this->isTestOnly()) {
            file_put_contents($modelPath, $modelFrameString);
        }

        return true;
    }

    /**
     * @param $table
     *
     * @return string|null
     */
    public function getShortenTableName($table)
    {
        $name = explode('_', $table, 2);

        return array_pop($name);
    }

    /**
     * @param $table
     *
     * @return array
     */
    public function getMetadata($table)
    {
        return app()->db()->getMaster()->describe($table);
    }

    /**
     * @param string $vendor
     * @param string $module
     *
     * @return string
     */
    public function getModelNamespace($vendor, $module)
    {
        return ucfirst($vendor) . '\\' . ucfirst($module) . '\\Model';
    }

    /**
     * @param string $vendor
     * @param string $module
     * @param string $tail
     *
     * @return string
     */
    public function getModelClass($vendor, $module, $tail)
    {
        if (empty($vendor)) {
            // continue
        }
        if (empty($module)) {
            // continue
        }

        $arr = explode('_', $tail, 3);

        if (count($arr) > 2) {
            $model = str_replace(' ', '', ucwords(str_replace('_', ' ', $arr[1] . '_' . $arr[2])));
        } else {
            $model = str_replace(' ', '', ucwords(str_replace('_', ' ', $arr[1])));
        }

        return $model;
    }

    /**
     * @param string $vendor
     * @param string $module
     * @param string $tail
     *
     * @return string
     */
    public function getTableClass($vendor, $module, $tail)
    {

        return $this->getModelClass($vendor, $module, $tail) . 'Table';
    }

    /**
     * @param  array  $columns
     * @param  string $space
     *
     * @return string
     */
    public function generateExportArray($columns, $space = "\n\t\t")
    {
        $response = [];

        foreach ($columns as $name => $type) {
            $response[] = sprintf("'%s'=>%s", $name, $type);
        }

        return 'array(' . $space . implode(',' . $space, $response) . ')';

    }

    /**
     * @param $metadata
     *
     * @return string
     */
    public function generateModelMethods($metadata)
    {
        $response = [];

        if (count($metadata['primary']) == 1) {
            $array = array_keys($metadata['primary']);
            $colummName = array_pop($array);

            if ($colummName != 'id') {
                $response[] = strtr($this->modelGetter, [
                    ':getterName' => 'getId',
                    ':columnName' => $colummName,
                ]);
                $response[] = strtr($this->modelSetter, [
                    ':setterName' => 'setId',
                    ':columnName' => $colummName,
                ]);
            }
        }

        foreach ($metadata['column'] as $colummName => $columnType) {
            if (substr($colummName, 0, 3) == 'is_') {

                $name = $this->inflect(substr($colummName, 3));
                $response[] = strtr($this->modelGetter, [
                    ':getterName' => 'is' . $name,
                    ':columnName' => $colummName,
                ]);

                $response[] = strtr($this->modelGetter, [
                    ':getterName' => 'get' . $name,
                    ':columnName' => $colummName,
                ]);

                $response[] = strtr($this->modelSetter, [
                    ':setterName' => 'set' . $name,
                    ':columnName' => $colummName,
                ]);

            } else {
                $name = $this->inflect($colummName);

                $response[] = strtr($this->modelGetter, [
                    ':getterName' => 'get' . $name,
                    ':columnName' => $colummName,
                ]);

                $response[] = strtr($this->modelSetter, [
                    ':setterName' => 'set' . $name,
                    ':columnName' => $colummName,
                ]);
            }
        }

        return implode(PHP_EOL, $response);
    }

    /**
     * @param $string
     *
     * @return mixed
     */
    private function inflect($string)
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
    }

    public function generateTableMethods($metadata, $vars)
    {
        $response = [];

        $primary = $metadata['primary'];

        if (is_array($primary) && count($primary) == 1) {
            $primaryColumn = array_keys($primary)[0];
            $vars[':primaryColumn'] = $primaryColumn;
            $response[] = strtr($this->tableFindById, $vars);
//            $response[] =  strtr($this->tableGetPrimary, $vars);
        } else {
            $response[] = strtr($this->tableFindByIdNull, $vars);
//            $response[] =  strtr($this->tableGetPrimaryNull, $vars);
        }

//        $response[] =  strtr($this->tableGetColumn, $vars);
//        $response[] =  strtr($this->tableGetColumnNotPrimary, $vars);

        return implode(PHP_EOL, $response);
    }

    /**
     * @param        $string
     * @param string $class
     *
     * @return string
     */
    public function prepareForReplaceTable($string, $class)
    {
        $pos1 = strpos($string, '//START_TABLE_GENERATOR');
        $pos2 = strrpos($string, '//END_TABLE_GENERATOR');

        if (false === $pos1 || false === $pos2)
            throw new \InvalidArgumentException("Could not find //START_TABLE_GENERATOR OR //END_TABLE_GENERATOR for $class");


        return substr($string, 0, $pos1) . self::PREPARE_FOR_REPLACMENT . substr($string, $pos2 + strlen('//END_TABLE_GENERATOR'));
    }
}