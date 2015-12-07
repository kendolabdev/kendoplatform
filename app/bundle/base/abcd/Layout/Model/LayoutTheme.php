<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_layout_theme`
 */

namespace Layout\Model;

/**
 */
use Kendo\Model;

/**
 * Class LayoutTheme
 *
 * @package Layout\Model
 */
class LayoutTheme extends Model
{

    /**
     * @param $id
     *
     * @return bool|string
     */
    protected function checkTemplateDirExists($id)
    {
        if (empty($id))
            return false;

        $dir = sprintf(Kendo_ROOT_DIR . '/app/theme/%s/template', $id);

        if (is_dir($dir)) {
            return $dir;
        }

        return false;
    }

    /**
     * get views finder paths
     *
     * @return array
     */
    public function getViewFinderPaths()
    {
        $template = $this->getTemplate();

        $paths = [];

        foreach ([$this->getId(), $this->getParentThemeId()] as $id) {
            if (false != ($dir = $this->checkTemplateDirExists($id))) {
                $paths[] = $dir;
            }
        }

        $morePaths = $template->getViewFinderPaths();

        foreach ($morePaths as $path) {
            $paths[] = $path;
        }

        return $paths;
    }

    /**
     * @return LayoutTemplate
     */
    public function getTemplate()
    {
        return \App::table('layout.layout_template')
            ->findById($this->getTemplateId());
    }



    /**
     * @return array
     */
    public function getVariables()
    {
        if (empty($this->getVariableParams()))
            return [];

        return json_decode($this->getVariableParams(), true);
    }

    /**
     * @param $data
     */
    public function setVariables($data)
    {
        $this->setVariableParams(json_encode($data));
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getName();
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('theme_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('theme_id', $value);
    }

    /**
     * @return null|string
     */
    public function getThemeId(){
       return $this->__get('theme_id');
    }

    /**
     * @param $value
     */
    public function setThemeId($value){
       $this->__set('theme_id', $value);
    }

    /**
     * @return null|string
     */
    public function getName(){
       return $this->__get('name');
    }

    /**
     * @param $value
     */
    public function setName($value){
       $this->__set('name', $value);
    }

    /**
     * @return null|string
     */
    public function getExtensionName(){
       return $this->__get('extension_name');
    }

    /**
     * @param $value
     */
    public function setExtensionName($value){
       $this->__set('extension_name', $value);
    }

    /**
     * @return null|string
     */
    public function getParentThemeId(){
       return $this->__get('parent_theme_id');
    }

    /**
     * @param $value
     */
    public function setParentThemeId($value){
       $this->__set('parent_theme_id', $value);
    }

    /**
     * @return null|string
     */
    public function getSuperThemeId(){
       return $this->__get('super_theme_id');
    }

    /**
     * @param $value
     */
    public function setSuperThemeId($value){
       $this->__set('super_theme_id', $value);
    }

    /**
     * @return null|string
     */
    public function isActive(){
       return $this->__get('is_active');
    }

    /**
     * @return null|string
     */
    public function getActive(){
       return $this->__get('is_active');
    }

    /**
     * @param $value
     */
    public function setActive($value){
       $this->__set('is_active', $value);
    }

    /**
     * @return null|string
     */
    public function isEditing(){
       return $this->__get('is_editing');
    }

    /**
     * @return null|string
     */
    public function getEditing(){
       return $this->__get('is_editing');
    }

    /**
     * @param $value
     */
    public function setEditing($value){
       $this->__set('is_editing', $value);
    }

    /**
     * @return null|string
     */
    public function isDefault(){
       return $this->__get('is_default');
    }

    /**
     * @return null|string
     */
    public function getDefault(){
       return $this->__get('is_default');
    }

    /**
     * @param $value
     */
    public function setDefault($value){
       $this->__set('is_default', $value);
    }

    /**
     * @return null|string
     */
    public function getVariableParams(){
       return $this->__get('variable_params');
    }

    /**
     * @param $value
     */
    public function setVariableParams($value){
       $this->__set('variable_params', $value);
    }

    /**
     * @return null|string
     */
    public function getTemplateId(){
       return $this->__get('template_id');
    }

    /**
     * @param $value
     */
    public function setTemplateId($value){
       $this->__set('template_id', $value);
    }

    /**
     * @return null|string
     */
    public function getDescription(){
       return $this->__get('description');
    }

    /**
     * @param $value
     */
    public function setDescription($value){
       $this->__set('description', $value);
    }

    /**
     * @return null|string
     */
    public function getScreenShorts(){
       return $this->__get('screen_shorts');
    }

    /**
     * @param $value
     */
    public function setScreenShorts($value){
       $this->__set('screen_shorts', $value);
    }

    /**
     * @return \Layout\Model\LayoutThemeTable
     */
    public function table(){
        return \App::table('layout.layout_theme');
    }
    //END_TABLE_GENERATOR
}