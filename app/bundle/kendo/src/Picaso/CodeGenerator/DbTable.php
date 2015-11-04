<?php

namespace Picaso\CodeGenerator;

/**
 * Class DbTable
 *
 * @package Picaso\CodeGenerator
 */
class DbTable
{

    const PREPARE_FOR_REPLACMENT = '//[PREPARE_FOR_REPLACMENT]';

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
     * @throws \Picaso\Db\Exception
     */
    public function findById($value){
       throw new \Picaso\Db\Exception(\'Can not find by id for \'.$value);
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
use Picaso\Model;

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
        return \App::table(\':tableAlias\');
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
use Picaso\Db\DbTable;

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
     * @param $table
     *
     * @return mixed|null|string
     * @throws Exception
     */
    public function generate($table)
    {


        $shortenTableName = $this->getShortenTableName($table);

        if (null == $shortenTableName) {
            return null;
        }

        $metadata = $this->getMetadata($table);


        $parse = explode('_', $shortenTableName, 2);

        $head = $parse[0];

        // all head with system => picaso
        if ($head == 'system') {
            $head = 'picaso';
        }

        $tail = null;
        $tableAlias = $head;

        if (count($parse) > 1) {
            $tail = $parse[1];
            $tableAlias = $head . '.' . $shortenTableName;
        }

        echo $head, '.', $shortenTableName, PHP_EOL;


        $modelNamespace = $this->getModelNamespace($head, $tail);
        $modelClass = $this->getModelClass($head, $shortenTableName);
        $tableClass = $this->getTableClass($head, $shortenTableName);
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

        $tablePath = \App::autoload()->getPath($fullTableClass);

        $oldTablePath = \App::autoload()->getPath($fullModelClass . 'DbTable');

        if (file_exists($oldTablePath)) {
            unlink($oldTablePath);
        }


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
        $modelPath = \App::autoload()->getPath($fullModelClass);

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

        file_put_contents($modelPath, $modelFrameString);

        return true;
    }

    /**
     * @param $table
     *
     * @return string|null
     */
    public function getShortenTableName($table)
    {
        $prefix = \App::db()->getPrefix();

        $name = str_replace($prefix, '', $table);

        if ($name == $table) {
            return null;
        }

        return $name;
    }

    /**
     * @param $table
     *
     * @return array
     */
    public function getMetadata($table)
    {
        return \App::db()->getMaster()->describe($table);
    }

    /**
     * @param $head
     *
     * @return string
     */
    public function getModelNamespace($head)
    {
        if ($head == 'system') {
            $head = 'picaso';
        }


        return ucfirst($head) . '\\Model';
    }

    /**
     * @param        $head
     * @param string $tail
     *
     * @return string
     */
    public function getModelClass($head, $tail)
    {

        $model = null;
        if ($tail) {
            $model = str_replace(' ', '', ucwords(str_replace('_', ' ', $tail)));

        } else {
            $model = ucfirst($head);
        }

        return $model;
    }

    /**
     * @param        $head
     * @param string $tail
     *
     * @return string
     */
    public function getTableClass($head, $tail)
    {
        return $this->getModelClass($head, $tail) . 'Table';
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
     * @param  $string
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