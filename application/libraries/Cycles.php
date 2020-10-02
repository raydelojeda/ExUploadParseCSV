<?php
class Cycles
{
    public function __construct()
    {
        ini_set('max_execution_time', 1000);
        //ini_set('memory_limit', '2048M');
    }

    //-----------------------------------------15th-----------------------------------------

    //----------Script----------
    function Loop_Script($array, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array('StepList', 'Group');
        $start_tag_name = array('Script');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_s = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($s = 0; $s < $cant_s; $s++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$s]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_FileID';
            $datas['_kf_FileID'] = $file_pk;

            $table='XMLScripts';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (array_key_exists('last_id', $result['data']))
            {
                $script_pk = $result['data']['last_id'];
                if(isset($array->Script[$s]->StepList[0]))$this->Loop_StepList($array->Script[$s]->StepList[0], $script_pk, $file_pk);
                //if(isset($array->Script[$s]->Group[0]))$this->Loop_StepList($array->Script[$s]->Group[0], $script_pk);
            }
            else
                print $result['error_msg'];
        }
    }
    //----------Script----------

    //----------StepList----------
    function Loop_StepList($array, $script_pk, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array('Step', 'StepText', 'CurrentScript', 'Script');//
        $tag_excluded = array();//'SortList', 'Calculation', 'DisplayCalculation'
        $start_tag_name = array('Step');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_p = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($p = 0; $p < $cant_p; $p++)
        {
            //echo $array_fields[$p].'<br>';
            $return_arr = $this->Split_StringIntoArrays($array_fields[$p]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_ScriptID';
            $datas['_kf_ScriptID'] = $script_pk;

            $fields[] = '_kf_FileID';
            $datas['_kf_FileID'] = $file_pk;

            $table='XMLSteps';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (array_key_exists('last_id', $result['data']))
            {
                $step_pk = $result['data']['last_id'];//var_dump($array->Step[$p]);print '<br><br>';//die();
                if(isset($array->Step[$p]))$this->Loop_StepParameters($array->Step[$p], $step_pk, '_kf_StepID');//TODO
                if(isset($array->Step[$p]))$this->Loop_Calculation($array->Step[$p], $step_pk, '_kf_StepID', '', '', 'Step', $file_pk);//TODO
                if(isset($array->Step[$p]))$this->Loop_SortList($array->Step[$p], $step_pk, '_kf_StepID', '', '', 'LeftTable', $file_pk);

            }
            else
                print $result['error_msg'];
        }
    }
    //----------StepList----------

    //-----------------------------------------15th-----------------------------------------

    //-----------------------------------------14th-----------------------------------------

    //----------Theme----------
    function Loop_Theme($array, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array('CustomStyles', 'DefaultStyles');
        $start_tag_name = array('Theme');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_t = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($t = 0; $t < $cant_t; $t++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$t]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_FileID';
            $datas['_kf_FileID'] = $file_pk;

            $table='XMLTheme';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (array_key_exists('last_id', $result['data']))
            {
                $theme_pk = $result['data']['last_id'];
                if(isset($array->Theme[$t]->CustomStyles[0]))$this->Loop_CustomStyles($array->Theme[$t]->CustomStyles[0], $theme_pk);
            }
            else
                print $result['error_msg'];
        }
    }
    //----------Theme----------

    //----------CustomStyles----------
    function Loop_CustomStyles($array, $theme_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array();
        $start_tag_name = array('Style');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_i = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($i = 0; $i < $cant_i; $i++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$i]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_ThemeID';
            $datas['_kf_ThemeID'] = $theme_pk;

            $table='XMLStyle';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (!array_key_exists('last_id', $result['data']))
                print $result['error_msg'];
        }
    }
    //----------CustomStyles----------

    //-----------------------------------------14th-----------------------------------------

    //-----------------------------------------13th-----------------------------------------

    //----------RelationshipList----------
    function Loop_RelationshipGraph_RelationshipList($array, $file_pk)
    {

        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array('JoinPredicateList', 'SortList');
        $start_tag_name = array('Relationship');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;die();
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_r = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($r = 0; $r < $cant_r; $r++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$r]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_FileID';
            $datas['_kf_FileID'] = $file_pk;

            $table='XMLRelationship';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);


            if (array_key_exists('last_id', $result['data']))
            {
                $relationship_pk = $result['data']['last_id'];
                if(isset($array->Relationship[$r]))$this->Loop_SortList($array->Relationship[$r], $relationship_pk, '_kf_RelationshipID', '', '', 'LeftTable', $file_pk);
                if(isset($array->Relationship[$r]->JoinPredicateList[0]))$this->Loop_JoinPredicateList($array->Relationship[$r]->JoinPredicateList[0], $relationship_pk);
            }
            else
                print $result['error_msg'];
        }
    }
    //----------RelationshipList----------

    //----------JoinPredicate----------
    function Loop_JoinPredicateList($array, $relationship_pk)
    {

        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array();
        $start_tag_name = array('JoinPredicate');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;die();
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_j = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($j = 0; $j < $cant_j; $j++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$j]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_RelationshipID';
            $datas['_kf_RelationshipID'] = $relationship_pk;

            $table='XMLJoinPredicate';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (!array_key_exists('last_id', $result['data']))
                print $result['error_msg'];
        }
    }
    //----------JoinPredicate----------

    //----------TableList----------
    function Loop_RelationshipGraph_TableList($array, $file_pk)
    {

        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array();
        $start_tag_name = array('Table');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;die();
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_l = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($l = 0; $l < $cant_l; $l++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$l]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_FileID';
            $datas['_kf_FileID'] = $file_pk;

            $table='XMLTableList';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (!array_key_exists('last_id', $result['data']))
                print $result['error_msg'];
        }
    }
    //----------TableList----------

    //-----------------------------------------13th-----------------------------------------

    //-----------------------------------------12th-----------------------------------------

    //----------Options----------
    function Loop_Options($array, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array('ThemeCatalog','BaseTableCatalog','LayoutCatalog','ValueListCatalog','ScriptCatalog','AccountCatalog','PrivilegesCatalog','ExtendedPrivilegeCatalog','AuthFileCatalog','CustomFunctionCatalog','ExternalDataSourcesCatalog','CustomMenuSetCatalog','CustomMenuCatalog');
        $start_tag_name = array('Options');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;die();
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_e = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($e = 0; $e < $cant_e; $e++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$e]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_FileID';
            $datas['_kf_FileID'] = $file_pk;

            $table='XMLOptions';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (!array_key_exists('last_id', $result['data']))
                print $result['error_msg'];
        }
    }
    //----------Options----------

    //-----------------------------------------12th-----------------------------------------


    //-----------------------------------------11th-----------------------------------------

    //----------CustomMenu----------
    function Loop_CustomMenu($array, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array('MenuItemList', 'Conditions', 'Title');
        $start_tag_name = array('CustomMenu');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_m = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($m = 0; $m < $cant_m; $m++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$m]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_FileID';
            $datas['_kf_FileID'] = $file_pk;

            $table='XMLCustomMenus';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (array_key_exists('last_id', $result['data']))
            {
                $custom_menu_pk = $result['data']['last_id'];
                if(isset($array->CustomMenu[$m]->MenuItemList[0]))$this->Loop_MenuItemList($array->CustomMenu[$m]->MenuItemList[0], $custom_menu_pk, $file_pk);
                if(isset($array->CustomMenu[$m]->Conditions[0]))$this->Loop_Calculation($array->CustomMenu[$m]->Conditions[0], $custom_menu_pk, '_kf_CustomMenu', '', '', 'Install', $file_pk);
                if(isset($array->CustomMenu[$m]->Title[0]))$this->Loop_Calculation($array->CustomMenu[$m]->Title[0], $custom_menu_pk, '_kf_CustomMenu', '', '', 'Title', $file_pk);

            }
            else
                print $result['error_msg'];
        }
    }
    //----------CustomMenu----------

    //----------MenuItemList----------
    function Loop_MenuItemList($array, $custom_menu_pk, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array('Name', 'Conditions', 'Step', 'Calculation', 'DisplayCalculation');
        $start_tag_name = array('MenuItem');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_i = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($i = 0; $i < $cant_i; $i++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$i]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_CustomMenuID';
            $datas['_kf_CustomMenuID'] = $custom_menu_pk;

            $table='XMLCustomMenuItems';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (array_key_exists('last_id', $result['data']))
            {
                $menu_item_pk = $result['data']['last_id'];
                if(isset($array->MenuItem[$i]->Name[0]))$this->Loop_Calculation($array->MenuItem[$i]->Name[0], $menu_item_pk, '_kf_CustomMenuItem', '', '', 'Name', $file_pk);
                if(isset($array->MenuItem[$i]->Conditions[0]))$this->Loop_Calculation($array->MenuItem[$i]->Conditions[0], $menu_item_pk, '_kf_CustomMenuItem', '', '', 'Install', $file_pk);
                if(isset($array->MenuItem[$i]->Step[0]))$this->Loop_Step($array->MenuItem[$i], $menu_item_pk, '_kf_MenuItemID', $file_pk);

                //if(isset($array->MenuItem[$i]->Step[0]))$this->Loop_Calculation($array->MenuItem[$i]->Step[0], $menu_item_pk, '_kf_CustomMenuItem', '', '', 'Step', $file_pk);
            }
            else
                print $result['error_msg'];
        }
    }
    //----------MenuItemList----------

    //-----------------------------------------11th-----------------------------------------

    //-----------------------------------------10th-----------------------------------------

    //----------CustomMenuSet----------
    function Loop_CustomMenuSet($array, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array('CustomMenuList');
        $start_tag_name = array('CustomMenuSet');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_c = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($c = 0; $c < $cant_c; $c++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$c]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_FileID';
            $datas['_kf_FileID'] = $file_pk;

            $table='XMLCustomMenuSets';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (array_key_exists('last_id', $result['data']))
            {
                $custom_menu_set_pk = $result['data']['last_id'];
                if(isset($array->CustomMenuSet[$c]->CustomMenuList[0]))$this->Loop_CustomMenuList($array->CustomMenuSet[$c]->CustomMenuList[0], $custom_menu_set_pk);
            }
            else
                print $result['error_msg'];
        }
    }
    //----------CustomMenuSet----------

    //----------CustomMenuList----------
    function Loop_CustomMenuList($array, $custom_menu_set_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array();
        $start_tag_name = array('CustomMenu');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_c = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($c = 0; $c < $cant_c; $c++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$c]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_CustomMenuSetID';
            $datas['_kf_CustomMenuSetID'] = $custom_menu_set_pk;

            $table='XMLCustomMenuSets_CustomMenus';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (array_key_exists('last_id', $result['data']))
            {
                $extended_privilege_pk = $result['data']['last_id'];
                //if(isset($array->CustomMenuList[0]->CustomMenu[$c]))$this->Loop_CustomMenuList($array->CustomMenuList[0]->CustomMenu[$c], $extended_privilege_pk);
            }
            else
                print $result['error_msg'];
        }
    }
    //----------CustomMenuList----------

    //-----------------------------------------10th-----------------------------------------

    //-----------------------------------------9th-----------------------------------------

    //----------ExternalDataSources----------
    function Loop_ExternalDataSources($array, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array();
        $start_tag_name = array('FileReference');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_e = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($e = 0; $e < $cant_e; $e++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$e]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_FileID';
            $datas['_kf_FileID'] = $file_pk;

            $table='XMLFileReference';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (!array_key_exists('last_id', $result['data']))
                print $result['error_msg'];
        }
    }
    //----------ExternalDataSources----------

    //-----------------------------------------9th-----------------------------------------

    //-----------------------------------------8th-----------------------------------------

    //----------CustomFunction----------
    function Loop_CustomFunction($array, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array('Calculation', 'DisplayCalculation');
        $start_tag_name = array('CustomFunction');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_f = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($f = 0; $f < $cant_f; $f++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$f]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_FileID';
            $datas['_kf_FileID'] = $file_pk;

            $table='XMLCustomFunctions';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (array_key_exists('last_id', $result['data']))
            {
                $custom_function_pk = $result['data']['last_id'];
                $this->Loop_Calculation($array->CustomFunction[$f], $custom_function_pk, '_kf_CustomFunction', '', '', 'CustomFunction', $file_pk);
            }
            else
                print $result['error_msg'];
        }
    }
    //----------CustomFunction----------

    //-----------------------------------------8th-----------------------------------------

    //-----------------------------------------7th-----------------------------------------

    //----------AuthFile----------
    function Loop_AuthFile($array, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array('Options', 'Inbound', 'Outbound', 'ThemeCatalog','BaseTableCatalog','LayoutCatalog','ValueListCatalog','ScriptCatalog','AccountCatalog','PrivilegesCatalog','ExtendedPrivilegeCatalog','CustomFunctionCatalog','ExternalDataSourcesCatalog','CustomMenuSetCatalog','CustomMenuCatalog');
        $start_tag_name = array('AuthFileCatalog');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;//AuthFileCatalog
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_a = sizeof($array_fields);//echo 'cant_table: '.$cant_e.'<br><br><br><br>';
        for ($a = 0; $a < $cant_a; $a++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$a]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_FileID';
            $datas['_kf_FileID'] = $file_pk;

            $table='XMLAuthorizedFiles';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (array_key_exists('last_id', $result['data']))
            {
                $file_access_pk = $result['data']['last_id'];
                if(isset($array->AuthFileCatalog[0]->Inbound[0]))$this->Loop_AuthFileInbound($array->AuthFileCatalog[0]->Inbound[0], $file_pk);
                if(isset($array->AuthFileCatalog[0]->Outbound[0]))$this->Loop_AuthFileOutbound($array->AuthFileCatalog[0]->Outbound[0], $file_pk);
            }
            else
                print $result['error_msg'];
        }
    }
    //----------AuthFile----------

    //----------AuthFileInbound----------
    function Loop_AuthFileInbound($array, $file_pk)
    {
        //var_dump($array);
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array();
        $start_tag_name = array('InboundAuthorization');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;//AuthFileCatalog
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_i = sizeof($array_fields);//echo 'cant_table: '.$cant_i.'<br><br><br><br>';
        for ($i = 0; $i < $cant_i; $i++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$i]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_FileID';
            $datas['_kf_FileID'] = $file_pk;

            $table='XMLAuthorizedFiles_Inbound';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (!array_key_exists('last_id', $result['data']))
                print $result['error_msg'];
        }
    }
    //----------AuthFileInbound----------

    //----------AuthFileOutbound----------
    function Loop_AuthFileOutbound($array, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array();
        $start_tag_name = array('OutboundAuthorization');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;//AuthFileCatalog
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_o = sizeof($array_fields);//echo 'cant_table: '.$cant_e.'<br><br><br><br>';
        for ($o = 0; $o < $cant_o; $o++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$o]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_FileID';
            $datas['_kf_FileID'] = $file_pk;

            $table='XMLAuthorizedFiles_Outbound';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (!array_key_exists('last_id', $result['data']))
                print $result['error_msg'];
        }
    }
    //----------AuthFileOutbound----------

    //-----------------------------------------7th-----------------------------------------

    //-----------------------------------------6th-----------------------------------------

    //----------ExtendedPrivilege----------
    function Loop_ExtendedPrivilege($array, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array('PrivilegeSetList');
        $start_tag_name = array('ExtendedPrivilege');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_e = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($e = 0; $e < $cant_e; $e++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$e]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_FileID';
            $datas['_kf_FileID'] = $file_pk;

            $table='XMLExtendedPrivileges';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (array_key_exists('last_id', $result['data']))
            {
                $extended_privilege_pk = $result['data']['last_id'];
                if(isset($array->ExtendedPrivilege[$e]->PrivilegeSetList[0]))$this->Loop_ExtendedPrivileges_PrivilegeSets($array->ExtendedPrivilege[$e]->PrivilegeSetList[0], $extended_privilege_pk);
            }
            else
                print $result['error_msg'];
        }
    }
    //----------ExtendedPrivilege----------

    //----------ExtendedPrivileges_PrivilegeSets----------
    function Loop_ExtendedPrivileges_PrivilegeSets($array, $extended_privilege_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array();
        $start_tag_name = array('PrivilegeSet');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_e = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($e = 0; $e < $cant_e; $e++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$e]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_ExtendedPrivilegeID';
            $datas['_kf_ExtendedPrivilegeID'] = $extended_privilege_pk;

            $table='XMLExtendedPrivileges_PrivilegeSets';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (!array_key_exists('last_id', $result['data']))
                print $result['error_msg'];
        }
    }
    //----------ExtendedPrivileges_PrivilegeSets----------

    //-----------------------------------------6th-----------------------------------------


    //-----------------------------------------5th-----------------------------------------

    //----------PrivilegeSet----------
    function Loop_PrivilegeSet($array, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array('TableList', 'LayoutList', 'ValueListList', 'ScriptList');//, 'ExternalObject', 'Chunk', 'Sort'
        $start_tag_name = array('PrivilegeSet');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_p = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($p = 0; $p < $cant_p; $p++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$p]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_FileID';
            $datas['_kf_FileID'] = $file_pk;

            $table='XMLPrivilegeSet';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (array_key_exists('last_id', $result['data']))
            {
                $privilegeset_pk = $result['data']['last_id'];
                if(isset($array->PrivilegeSet[$p]->Records[0]->TableList[0]))$this->Loop_PrivilegeSetRecords($array->PrivilegeSet[$p]->Records[0]->TableList[0], $privilegeset_pk, $file_pk);
                if(isset($array->PrivilegeSet[$p]->Layouts[0]->LayoutList[0]))$this->Loop_PrivilegeSetLayouts($array->PrivilegeSet[$p]->Layouts[0]->LayoutList[0], $privilegeset_pk);
                if(isset($array->PrivilegeSet[$p]->ValueLists[0]->ValueListList[0]))$this->Loop_PrivilegeSetValueLists($array->PrivilegeSet[$p]->ValueLists[0]->ValueListList[0], $privilegeset_pk);
                if(isset($array->PrivilegeSet[$p]->Scripts[0]->ScriptList[0]))$this->Loop_PrivilegeSetScripts($array->PrivilegeSet[$p]->Scripts[0]->ScriptList[0], $privilegeset_pk);
            }
            else
                print $result['error_msg'];
        }
    }
    //----------PrivilegeSet----------

    //----------PrivilegeSetValueLists----------
    function Loop_PrivilegeSetValueLists($array, $privilegeset_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array();//, 'ExternalObject', 'Chunk', 'Sort'
        $start_tag_name = array('ValueList');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_v = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($v = 0; $v < $cant_v; $v++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$v]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_PrivilegeSetID';
            $datas['_kf_PrivilegeSetID'] = $privilegeset_pk;

            $table='XMLPrivilegeSet_ValueLists';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (!array_key_exists('last_id', $result['data']))
                print $result['error_msg'];
        }
    }
    //----------PrivilegeSetValueLists----------

    //----------PrivilegeSetScripts----------
    function Loop_PrivilegeSetScripts($array, $privilegeset_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array();//, 'ExternalObject', 'Chunk', 'Sort'
        $start_tag_name = array('Script');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_v = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($v = 0; $v < $cant_v; $v++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$v]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_PrivilegeSetID';
            $datas['_kf_PrivilegeSetID'] = $privilegeset_pk;

            $table='XMLPrivilegeSet_Scripts';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (!array_key_exists('last_id', $result['data']))
                print $result['error_msg'];
        }
    }
    //----------PrivilegeSetScripts----------

    //----------PrivilegeSetLayouts----------
    function Loop_PrivilegeSetLayouts($array, $privilegeset_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array();//, 'ExternalObject', 'Chunk', 'Sort'
        $start_tag_name = array('Layout');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_l = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($l = 0; $l < $cant_l; $l++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$l]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_PrivilegeSetID';
            $datas['_kf_PrivilegeSetID'] = $privilegeset_pk;

            $table='XMLPrivilegeSet_Layouts';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (!array_key_exists('last_id', $result['data']))
                print $result['error_msg'];
        }
    }
    //----------PrivilegeSetLayouts----------

    //----------PrivilegeSetRecords----------
    function Loop_PrivilegeSetRecords($array, $privilegeset_pk, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array('FieldList', 'Calculation', 'DisplayCalculation');//, 'ExternalObject', 'Chunk', 'Sort'
        $start_tag_name = array('BaseTable');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_r = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($r = 0; $r < $cant_r; $r++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$r]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_PrivilegeSetID';
            $datas['_kf_PrivilegeSetID'] = $privilegeset_pk;

            $table='XMLPrivilegeSet_Records';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (array_key_exists('last_id', $result['data']))
            {
                $privilegeset_record_pk = $result['data']['last_id'];
                if(isset($array->BaseTable[$r]->FieldAccess[0]->FieldList[0]))$this->Loop_PrivilegeSetRecordFields($array->BaseTable[$r]->FieldAccess[0]->FieldList[0], $privilegeset_record_pk, $file_pk);
                if(isset($array->BaseTable[$r]))$this->Loop_Calculation($array->BaseTable[$r], $privilegeset_record_pk, '_kf_PrivilegeSet_RecordID', '', '', 'Create', $file_pk);
            }
            else
                print $result['error_msg'];
        }
    }
    //----------PrivilegeSetRecords----------

    //----------PrivilegeSetRecordsFields----------
    function Loop_PrivilegeSetRecordFields($array, $privilegeset_record_pk, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array();//, 'ExternalObject', 'Chunk', 'Sort'
        $start_tag_name = array('Field');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_f = sizeof($array_fields);//echo 'cant_table: '.$cant_f.'<br><br><br><br>';
        for ($f = 0; $f < $cant_f; $f++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$f]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_PrivilegeSetRecordID';
            $datas['_kf_PrivilegeSetRecordID'] = $privilegeset_record_pk;

            $table='XMLPrivilegeSet_Record_Fields';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (array_key_exists('last_id', $result['data']))
            {
                $privilegeset_record_field_pk = $result['data']['last_id'];//var_dump($array->Field[$f]);die();
                if(isset($array->Field[$f]))$this->Loop_Calculation($array->Field[$f], $privilegeset_record_field_pk, '_kf_PrivilegeSet_Record_FieldID', '', '', 'Field', $file_pk);
            }
            else
                print $result['error_msg'];
        }
    }
    //----------PrivilegeSetRecordsFields----------

    //-----------------------------------------5th-----------------------------------------


    //-----------------------------------------3rd-----------------------------------------

    //----------ValueList----------
    function Loop_ValueList($array, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array();//, 'ExternalObject', 'Chunk', 'Sort'
        $start_tag_name = array('ValueList');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_l = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($l = 0; $l < $cant_l; $l++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$l]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_FileID';
            $datas['_kf_FileID'] = $file_pk;

            $table='XMLValueList';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (!array_key_exists('last_id', $result['data']))
                print $result['error_msg'];
        }
    }
    //----------ValueList----------

    //-----------------------------------------3rd-----------------------------------------


    //-----------------------------------------2nd-----------------------------------------

    //----------Group----------
    function Loop_Group($array, $file_pk)
    {
        $my_instance =& get_instance();
        $groups=array();
        $tag_included = array();
        $tag_excluded = array('Layout');
        $start_tag_name = array('Group');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_g = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($g = 0; $g < $cant_g; $g++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$g]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_FileID';
            $datas['_kf_FileID'] = $file_pk;

            $table='XMLGroups';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (array_key_exists('last_id', $result['data']))
            {
                $group_pk = $result['data']['last_id'];
                $groups[$g]=$group_pk;
            }
            else
                print $result['error_msg'];
        }
        echo json_encode(array('arr_groups' => $groups, 'file_pk' => $file_pk));
    }
    //----------Group----------

    //----------Layout----------
    function Loop_Layout($array, $file_pk, $group_pk = NULL)
    {
        $my_instance =& get_instance();
        $layouts = array();
        $tag_included = array();
        $tag_excluded = array('Group', 'Object', 'ScriptTriggers');//, 'ExternalObject', 'Chunk', 'Sort'
        $start_tag_name = array('Layout');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        //$cant_l = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        foreach($array_fields as $key=>$val)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$key]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_FileID';
            $datas['_kf_FileID'] = $file_pk;

            $fields[] = '_kf_GroupID';
            $datas['_kf_GroupID'] = $group_pk;

            $table='XMLLayouts';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (array_key_exists('last_id', $result['data']))
            {
                $layout_pk = $result['data']['last_id'];
                $layouts[]=$layout_pk;
            }
            else
                print $result['error_msg'];
        }
        echo json_encode(array('layouts' => $layouts, 'file_pk' => $file_pk));

    }
    //----------Layout----------

    //----------Object----------
    function Loop_Object($array, $layout_pk, $parent_pk=NULL, $print=0, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included=array();
        $tag_excluded=array('Calculation', 'DisplayCalculation', 'FieldObj', 'TextObj', 'GroupButtonObj', 'ButtonObj', 'ButtonBarObj', 'TabControlObj', 'TabPanelObj', 'SlideControlObj', 'SlidePanelObj', 'PortalObj',
            'ExternalObj', 'PopoverButtonObj', 'PopoverObj', 'ButtonBarObj', 'GraphicObj', 'ExtendedAttributes', 'LocalCSS', 'ScriptTriggers', 'Step', 'SortList', 'ConditionalFormatting', 'Format');
        $start_tag_name=array('Object');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included,0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_o = sizeof($array_fields);//echo 'cant_obj: '.$cant_o.'<br><br><br><br>';
        if($cant_o>0)
        {
            foreach($array_fields as $key=>$val)
            {
                $return_arr = $this->Split_StringIntoArrays($array_fields[$key]);

                $fields = $return_arr[0];
                $datas = $return_arr[1];

                $fields[] = '_kf_FileID';
                $datas['_kf_FileID'] = $file_pk;

                $fields[] = '_kf_LayoutID';
                $datas['_kf_LayoutID'] = $layout_pk;

                $fields[] = '_kf_Parent_ObjectID';
                $datas['_kf_Parent_ObjectID'] = $parent_pk;

                $table='XMLObjects';

                if($first)
                    $this->FillStatus($table, 'FIRST');

                $first=FALSE;

                $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

                if (array_key_exists('last_id', $result['data']))
                {
                    $object_pk = $result['data']['last_id'];
                    if(isset($array->Object[$key]))$this->Loop_SubObject($array->Object[$key], $object_pk, $layout_pk, $file_pk);
                    if(isset($array->Object[$key]))$this->Loop_ExternalObject($array->Object[$key], $object_pk, $layout_pk, $file_pk);//EXTERNAL OBJECT ISN'T DEVELOPED YET
                    if(isset($array->Object[$key]))$this->Loop_Calculation($array->Object[$key], $object_pk, '_kf_ObjectID', '', '', 'Object', $file_pk);
                    if(isset($array->Object[$key]))$this->Loop_ScriptTriggers($array->Object[$key], $object_pk, '_kf_ObjectID', $file_pk);
                    if(isset($array->Object[$key]))$this->Loop_SortList($array->Object[$key], $object_pk, '_kf_ObjectID', '', '', 'Object', $file_pk);
                    if(isset($array->Object[$key]))$this->Loop_Object($array->Object[$key], $layout_pk, $parent_pk, 0, $file_pk);
                    if(isset($array->Object[$key]))$this->Loop_ConditionalFormatting($array->Object[$key], $object_pk, '_kf_ObjectID', $file_pk);
                } else
                    print $result['error_msg'];
            }
        }
        else
            $parent_pk = NULL;
    }
    //----------Object----------

    //----------ConditionalFormatting----------
    function Loop_ConditionalFormatting($array, $pk, $pk_name, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array('Calculation', 'DisplayCalculation', 'Format');
        $start_tag_name = array('ConditionalFormatting');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_e = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($e = 0; $e < $cant_e; $e++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$e]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_FileID';
            $datas['_kf_FileID'] = $file_pk;

            $fields[] = $pk_name;
            $datas[$pk_name] = $pk;

            $table='XMLConditionalFormatting';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (array_key_exists('last_id', $result['data']))
            {
                $conditional_pk = $result['data']['last_id'];//var_dump($array->Step[$p]);print '<br><br>';//die();
                if(isset($array->ConditionalFormatting[$e]))$this->Loop_Calculation($array->ConditionalFormatting[$e], $conditional_pk, '_kf_ConditionalFormID', '', '', 'ConditionalFormatting', $file_pk);
            } else
                print $result['error_msg'];
        }
    }
    //----------ConditionalFormatting----------

    //----------SubObject----------
    function Loop_SubObject($array, $object_pk, $layout_pk, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array('SortList', 'Calculation', 'DisplayCalculation', 'CharacterStyleVector', 'ParagraphStyleVector', 'ExtendedAttributes', 'LocalCSS', 'Step', 'Object', 'ExternalObject');
        $start_tag_name = array($array['type'] . 'Obj');

        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

//        $cant_s = sizeof($array_fields);//echo 'cant_sub: '.$cant_s.'<br><br><br><br>';
//        if ($cant_s > 0)
//        {
            foreach($array_fields as $key=>$val)
            {
                $return_arr = $this->Split_StringIntoArrays($array_fields[$key]);

                $fields = $return_arr[0];
                $datas = $return_arr[1];

                $fields[] = '__kp_OBJECT_ID';
                $datas['__kp_OBJECT_ID'] = $object_pk;//print $array['type'].'<br>';

                if($first)
                    $this->FillStatus('XML' . $array['type'], 'FIRST');

                $first=FALSE;

                $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, 'XML' . $array['type'] . 'Obj');

                if (array_key_exists('last_id', $result['data']))
                {
                    $sub_object_pk = $object_pk;
                    $parent_pk = $object_pk;

                    if ($array['type'] == 'Field')
                    {
                        $arr = $array->FieldObj[$key];
                        $this->Loop_ExtendedAttributes($arr, $sub_object_pk, '_kf_FieldObjID');
                    }
                    elseif ($array['type'] == 'Text')
                    {
                        $arr = $array->TextObj[$key];
                        $this->Loop_ExtendedAttributes($arr, $sub_object_pk, '_kf_TextObjID');
                    }
                    elseif ($array['type'] == 'GroupButton')
                    {
                        $arr = $array->GroupButtonObj[$key];
                    }
                    elseif ($array['type'] == 'Button')
                    {
                        $arr = $array->ButtonObj[$key];
                    }
                    elseif ($array['type'] == 'ButtonBar')
                    {
                        $arr = $array->ButtonBarObj[$key];
                    }
                    elseif ($array['type'] == 'TabControl')
                    {
                        $arr = $array->TabControlObj[$key];
                    }
                    elseif ($array['type'] == 'TabPanel')
                    {
                        $arr = $array->TabPanelObj[$key];
                    }
                    elseif ($array['type'] == 'SlideControl')
                    {
                        $arr = $array->SlideControlObj[$key];
                    }
                    elseif ($array['type'] == 'SlidePanel')
                    {
                        $arr = $array->SlidePanelObj[$key];
                    }
                    elseif ($array['type'] == 'Portal')
                    {
                        $arr = $array->PortalObj[$key];
                    }
                    elseif ($array['type'] == 'External')
                    {
                        $arr = $array->ExternalObj[$key];
                    }
                    elseif ($array['type'] == 'PopoverButton')
                    {
                        $arr = $array->PopoverButtonObj[$key];
                    }
                    elseif ($array['type'] == 'Popover')
                    {
                        $arr = $array->PopoverObj[$key];
                    }
                    elseif ($array['type'] == 'ButtonBar')
                    {
                        $arr = $array->ButtonBarObj[$key];
                    }
                    elseif ($array['type'] == 'Graphic')
                    {
                        $arr = $array->GraphicObj[$key];
                    }

                    //$this->Loop_ExtendedAttributes($arr, $parent_pk, '_kf_ObjectID');//duplicated
                    $this->Loop_Step($arr, $parent_pk, '_kf_ObjectID', $file_pk);
                    $this->Loop_Object($arr, $layout_pk, $parent_pk, 0, $file_pk);
                } else
                    print $result['error_msg'];
            }
//        }
    }
    //----------SubObject----------

    //----------ExternalObject----------
    function Loop_ExternalObject($array, $object_pk, $layout_pk, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array('SortList', 'Calculation', 'DisplayCalculation', 'CharacterStyleVector', 'ParagraphStyleVector', 'ExtendedAttributes',
            'LocalCSS', 'Step', 'Object', 'ChartSeries', 'Visual', 'VisualExtension', 'Legend', 'CharacterStyle', 'Label', 'ChartAxis', 'Axis', 'DataLabelFormat');
        $start_tag_name = array('ExternalObj');

        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_s = sizeof($array_fields);
        //echo 'cant_sub: ' . $cant_s . '<br><br><br><br>';
        if ($cant_s > 0)
        {
            for ($s = 0; $s < $cant_s; $s++)
            {
                $str = $this->SubstituteExternalObj($array_fields[$s]);
                $return_arr = $this->Split_StringIntoArrays($str);

                $fields = $return_arr[0];
                $datas = $return_arr[1];

                $fields[] = '__kp_OBJECT_ID';
                $datas['__kp_OBJECT_ID'] = $object_pk;//print $array['type'].'<br>';

                $table='XMLExternalObj';

                if($first)
                    $this->FillStatus($table, 'FIRST');

                $first=FALSE;

                $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

                if (array_key_exists('last_id', $result['data']))
                {
                    $sub_object_pk = $object_pk;
                    $parent_pk = $object_pk;

                    if ($array['type'] == 'External')
                    {

                    }
                    $arr = $array->ExternalObj[$s];
                    $this->Loop_ExtendedAttributes($arr, $parent_pk, '_kf_ObjectID');
                    $this->Loop_Step($arr, $parent_pk, '_kf_ObjectID', $file_pk);
                    $this->Loop_Object($arr, $layout_pk, $parent_pk, 0, $file_pk);
                } else
                    print $result['error_msg'];
            }
        }
    }
    //----------ExternalObject----------

    //----------SubstituteExternalObj----------
    function SubstituteExternalObj($str)
    {
        $str = str_replace("ExternalObj", "EO", $str);
        $str = str_replace("SeriesSource", "SS", $str);
        $str = str_replace("ChartSeries", "CS", $str);
        $str = str_replace("ChartAxis", "XL", $str);
        $str = str_replace("Axis", "X", $str);
        $str = str_replace("CharacterStyle", "ChS", $str);

        return $str;
    }
    //----------SubstituteExternalObj----------

    //----------ScriptTriggers----------
    function Loop_ScriptTriggers($array, $pk, $pk_name, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array('Calculation', 'DisplayCalculation');
        $start_tag_name = array('ScriptTriggers');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_e = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($e = 0; $e < $cant_e; $e++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$e]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_FileID';
            $datas['_kf_FileID'] = $file_pk;

            $fields[] = $pk_name;
            $datas[$pk_name] = $pk;

            $table='XMLTriggers';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (array_key_exists('last_id', $result['data']))
            {
                $trigger_pk = $result['data']['last_id'];//var_dump($array->Step[$p]);print '<br><br>';//die();
                if(isset($array->ScriptTriggers[$e]))$this->Loop_Calculation($array->ScriptTriggers[$e], $trigger_pk, '_kf_TriggerID', '', '', 'ScriptTriggers', $file_pk);
            } else
                print $result['error_msg'];
        }
    }
    //----------ScriptTriggers----------

    //----------Step----------
    function Loop_Step($array, $pk, $pk_name, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array('Step', 'StepText', 'CurrentScript', 'Script');//, 'Calculation', 'DisplayCalculation'
        $tag_excluded = array();
        $start_tag_name = array('Step');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;die();
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_p = sizeof($array_fields);//echo 'cant_field: '.$cant_p.'<br><br><br><br>';
        for ($p = 0; $p < $cant_p; $p++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$p]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_FileID';
            $datas['_kf_FileID'] = $file_pk;

            $fields[] = $pk_name;
            $datas[$pk_name] = $pk;

            $table='XMLSteps';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (array_key_exists('last_id', $result['data']))
            {
                $step_pk = $result['data']['last_id'];//var_dump($array->Step[$p]);print '<br><br>';//die();
                $this->Loop_StepParameters($array->Step[0], $step_pk, '_kf_StepID');//TODO
                $this->Loop_Calculation($array->Step[0], $step_pk, '_kf_StepID', '', '', 'Step', $file_pk);//TODO
            } else
                print $result['error_msg'];
        }
    }
    //----------Step----------

    //----------StepParameters----------
    function Loop_StepParameters($array, $pk, $pk_name, $chain = '', $str_fields = '')
    {
        $my_instance =& get_instance();
        $tag_excluded = array('StepText', 'CurrentScript', 'Script', 'SortList');

        $first=TRUE;

        foreach ($array as $key => $val)
        {
            if (in_array($key, $tag_excluded))
            {
                end($val);//foreach ($val as $key1 => $val1){}
            }
            else
            {
                if ($chain == '')
                    $chain = $key;
                else
                    $chain = $chain . '_' . $key;

                if ($val->count() == 0 && $val != '')
                {

                    if ($str_fields == '')
                        $str_fields = $chain . '_t:^:^:' . $val . '';
                    else
                        $str_fields = $str_fields . '|^|^|' . $chain . '_t:^:^:' . $val . '';

                    //echo '<br>field_tag: ' . $chain . '_t > TAG: ' . $key .' value_inside_tag: '.$val. '<br><br>';
                }

                $str_fields = $this->Loop_Attr($str_fields, $chain, $val);

                $chain = $this->Delete_Last($chain);

                if ($str_fields != '')
                {
                    $return_arr = $this->Split_StringIntoArrays($str_fields);
                    $cant_fld = sizeof($return_arr[0]);

                    $fields=array();
                    $datas=array();

                    for ($fld = 0; $fld < $cant_fld; $fld++)
                    {
                        $fl=$return_arr[0][$fld];
                        $dt=$return_arr[1][$fl];

                        $fields[] = 'Parameter_Name ';
                        $datas['Parameter_Name '] = $fl;

                        $fields[] = 'Parameter_Value';
                        $datas['Parameter_Value'] = $dt;

                        $fields[] = $pk_name;
                        $datas[$pk_name] = $pk;

                        $table='XMLStepParameters';

                        if($first)
                            $this->FillStatus($table, 'FIRST');

                        $first=FALSE;

                        $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

                        if (array_key_exists('last_id', $result['data']))
                        {
                            $param_pk = $result['data']['last_id'];//var_dump($array->Field[$f]);
                            //print $param_pk . '<br><br>';var_dump($val);print '<br><br>';
                            //
                        } else
                            print $result['error_msg'];
                    }

                    $str_fields = '';
                }
            }
        }

    }
    //----------StepParameters----------

    //----------ExtendedAttributes----------
    function Loop_ExtendedAttributes($array, $sub_object_pk, $pk_name)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array('DateElement', 'DateElementSep');
        $start_tag_name = array('ExtendedAttributes');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_e = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($e = 0; $e < $cant_e; $e++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$e]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = $pk_name;
            $datas[$pk_name] = $sub_object_pk;

            $fields[] = '_kf_ObjectID';
            $datas['_kf_ObjectID'] = $sub_object_pk;

            $table='XMLExtAttr';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (array_key_exists('last_id', $result['data']))
            {
                $extended_attr_pk = $result['data']['last_id'];
                $this->Loop_DateElement($array->ExtendedAttributes[$e], $extended_attr_pk);
                $this->Loop_DateElementSep($array->ExtendedAttributes[$e], $extended_attr_pk);
            } else
                print $result['error_msg'];
        }
    }
    //----------ExtendedAttributes----------

    //----------DateElement----------
    function Loop_DateElement($array, $extended_attr_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array();
        $start_tag_name = array('DateElement');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_d = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($d = 0; $d < $cant_d; $d++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$d]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_ExtAttrID';
            $datas['_kf_ExtAttrID'] = $extended_attr_pk;

            $table='XMLExtAttr_DateElement';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (!array_key_exists('last_id', $result['data']))
                print $result['error_msg'];
        }
    }
    //----------DateElement----------

    //----------DateElementSep----------
    function Loop_DateElementSep($array, $extended_attr_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array();
        $start_tag_name = array('DateElementSep');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_s = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($s = 0; $s < $cant_s; $s++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$s]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_ExtAttrID';
            $datas['_kf_ExtAttrID'] = $extended_attr_pk;

            $table='XMLExtAttr_DateSeparator';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (!array_key_exists('last_id', $result['data']))
                print $result['error_msg'];
        }
    }
    //----------DateElementSep----------

    //-----------------------------------------2nd-----------------------------------------


    //-----------------------------------------1st-----------------------------------------

    //----------BaseTable----------
    function Loop_BaseTable($array, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array('FieldCatalog');
        $start_tag_name = array('BaseTable');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];
        $array_fields = $arr_fields[1];

        $first=TRUE;

        //$cant_t = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';for ($t = 0; $t < $cant_t; $t++)

        foreach($array_fields as $key=>$val)
        {
            //echo $index . ':' . $key . $array_fields[$key].'<br>';

            $return_arr = $this->Split_StringIntoArrays($array_fields[$key]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_FileID';
            $datas['_kf_FileID'] = $file_pk;

            $table='XMLTables';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (array_key_exists('last_id', $result['data']))
            {
                $table_pk = $result['data']['last_id'];
                $this->Loop_Field($array->BaseTable[$key]->FieldCatalog[0], $table_pk, $file_pk);
            } else
                print $result['error_msg'];
        }
    }
    //----------BaseTable----------

    //----------Field----------
    function Loop_Field($array, $table_pk, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array('Calculation', 'DisplayCalculation');
        $start_tag_name = array('Field');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;die();
        $array_fields = $arr_fields[1];

        $first=TRUE;

        //$cant_f = sizeof($array_fields);//echo 'cant_field: '.$cant_f.'<br><br><br><br>';
        foreach($array_fields as $key=>$val)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$key]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_TableID';
            $datas['_kf_TableID'] = $table_pk;

            $table='XMLFields';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (array_key_exists('last_id', $result['data']))
            {
                $field_pk = $result['data']['last_id'];//var_dump($array->Field[$f]);print '<br><br>';
                $this->Loop_Calculation($array->Field[$key], $field_pk, '_kf_FieldID', '', '', 'Field', $file_pk);
            } else
                print $result['error_msg'];

            //var_dump($array->Field[$f]);echo '<br><br>';
        }
        //Loop_DisplayCalculation($array->Field[0], '6238', '_kf_FieldID');
    }
    //----------Field----------

    //-----------------------------------------1st-----------------------------------------

    //-----------------------------------------4th-----------------------------------------

    //----------Account----------
    function Loop_Account($array, $file_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array();//, 'ExternalObject', 'Chunk', 'Sort'
        $start_tag_name = array('Account');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_l = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($l = 0; $l < $cant_l; $l++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$l]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_FileID';
            $datas['_kf_FileID'] = $file_pk;

            $table='XMLAccounts';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (!array_key_exists('last_id', $result['data']))
                print $result['error_msg'];
        }
    }
    //----------Account----------

    //-----------------------------------------4th-----------------------------------------


    function loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, $chain, $str_fields, $fields, $level, $print = 0)
    {
        //print ' start_tag: '.$start_tag_name[0].' cant:'.sizeof($array).' <br> ';
        foreach ($array as $key => $val)
        {
            //print 'key: '.$key.' '.$level.' '.'<br>';
            //var_dump($tag_excluded);
            if (in_array($key, $start_tag_name) && $level == '1')
                $str_fields = '';

            if (empty($tag_included))
            {
                if (in_array($key, $tag_excluded))
                {
                    end($val);//foreach ($val as $key1 => $val1){}
                } else
                {
                    require 'loop_aux.php';
                }
            }
            else
            {
                if (!in_array($key, $tag_included))
                {
                    end($val);//foreach ($val as $key1 => $val1){}
                } else
                {
                    require 'loop_aux.php';
                }
            }
        }
        //die();
        $arr_fields[0] = $str_fields;
        $arr_fields[1] = $fields;
        $arr_fields[2] = $level - 1;

        return $arr_fields;
    }

    function Delete_Last($chain)
    {
        $pos = strrpos($chain, "_");
        $chain = substr($chain, 0, $pos);
        return $chain;
    }

    function Loop_Attr($fields, $chain, $val)
    {
        foreach ($val->attributes() as $att_key => $att_val)
        {
            //echo $att_key.'<br>';
            if ($fields == '')
                $fields = $chain . '_' . $att_key . ':^:^:' . $att_val . '';
            else
                $fields = $fields . '|^|^|' . $chain . '_' . $att_key . ':^:^:' . $att_val . '';
        }

        return $fields;
    }

    function Split_StringIntoArrays($str, $beginning_str = '')
    {
        $fields = array();
        $datas = array();

        if ($str != '')
        {

            $att = explode("|^|^|", $str);
            $cant = sizeof($att);//echo $str.' cant: '.$cant.' -------<br><br><br>';

            if ($cant != 0)
            {
                for ($i = 0; $i < $cant; next($att), $i++)
                {
                    $current_att = current($att);
                    $arr = explode(":^:^:", $current_att);
                    $fields[$i] = $beginning_str . trim($arr[0]);//echo trim($arr[0]).' = '.trim($arr[1]).'<br>';
                    $datas[$beginning_str . trim($arr[0])] = trim($arr[1]);
                }
            }
        }

        $return_arr[0] = $fields;
        $return_arr[1] = $datas;
        //var_dump($return_arr);

        return $return_arr;
    }


    //----------SortList----------
    function Loop_SortList($array, $pk, $pk_name, $chain = '', $str_fields = '', $parent_tag = '', $file_pk=NULL)
    {
        $my_instance =& get_instance();
        $tag_excluded = array('Sort');
        //$start_tag_name=array('SortList');
        //$arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, 0, '', array(), 1);

        $first=TRUE;

        foreach ($array as $key => $val)
        {
            //print 'key: '.$key.' '.'<br>';
            if (in_array($key, $tag_excluded))
            {
                end($val);//foreach ($val as $key1 => $val1){}
            } elseif ($key == 'SortList')
            {
                $str_fields = $this->Loop_Attr($str_fields, 'SortList', $val);

                if ($val->count() == 0 && $val != '')
                {
                    if ($str_fields == '')
                        $str_fields = 'SortList_t:' . $val . '';
                    else
                        $str_fields = $str_fields . '|||SortList_t:' . $val . '';
                }

                $return_arr = $this->Split_StringIntoArrays($str_fields);

                $fields = $return_arr[0];
                $datas = $return_arr[1];

                $fields[] = $pk_name;
                $datas[$pk_name] = $pk;

                $fields[] = '_kf_FileID';
                $datas['_kf_FileID'] = $file_pk;

                $fields[] = 'Tag';
                $datas['Tag'] = $parent_tag;

                $table='XMLSortList';

                if($first)
                    $this->FillStatus($table, 'FIRST');

                $first=FALSE;

                $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

                if (array_key_exists('last_id', $result['data']))
                {
                    $sort_list_pk = $result['data']['last_id'];//var_dump($array->Field[$f]);print '<br><br>';
                } else
                    print $result['error_msg'];

                $this->Loop_Sort($val, $sort_list_pk);
            }

            if ($val->count() && isset($val->SortList))
            {
                $parent_tag = $key;//print 'parent_key: '.$parent_tag.' '.'<br>';
            }
            $arr_fields = $this->Loop_SortList($val, $pk, $pk_name, $chain, $str_fields, $parent_tag, $file_pk);
            $str_fields = $arr_fields[0];
            $fields = $arr_fields[1];
        }
    }
    //----------SortList----------

    //----------Sort----------
    function Loop_Sort($array, $sort_list_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array();
        $start_tag_name = array('Sort');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo $str_fields;
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_e = sizeof($array_fields);//echo 'cant_table: '.$cant_t.'<br><br><br><br>';
        for ($e = 0; $e < $cant_e; $e++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$e]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_SortListID';
            $datas['_kf_SortListID'] = $sort_list_pk;

            $table='XMLSort';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (!array_key_exists('last_id', $result['data']))
                print $result['error_msg'];
        }
    }
    //----------Sort----------

    //----------Calculation----------
    function Loop_Calculation($array, $pk, $pk_name, $chain = '', $str_fields = '', $parent_tag = '', $file_pk=NULL)
    {
        //echo '  file: '.$file_pk;

        $my_instance =& get_instance();

        $first=TRUE;
        //var_dump($array);print '<br><br>';
        foreach ($array as $key => $val)
        {
            //print 'key: '.$key.' '.'<br>';
            if ($key == 'Calculation')
            {
                $str_fields = $this->Loop_Attr($str_fields, 'Calculation', $val);

                if ($val->count() == 0 && $val != '')
                {
                    if ($str_fields == '')
                        $str_fields = 'Calculation_t:^:^:' . $val . '';
                    else
                        $str_fields = $str_fields . '|^|^|Calculation_t:^:^:' . $val . '';
                }

                $return_arr = $this->Split_StringIntoArrays($str_fields);

                $fields = $return_arr[0];
                $datas = $return_arr[1];

                $fields[] = $pk_name;
                $datas[$pk_name] = $pk;

                $fields[] = '_kf_FileID';
                $datas['_kf_FileID'] = $file_pk;

                $fields[] = 'Tag';
                $datas['Tag'] = $parent_tag;

                if($pk_name==='_kf_FieldID')
                    $datas['fk_key'] = 1;
                elseif($pk_name==='_kf_FileReferenceID')
                    $datas['fk_key'] = 2;
                elseif($pk_name==='_kf_LayoutID')
                    $datas['fk_key'] = 3;
                elseif($pk_name==='_kf_ObjectID')
                    $datas['fk_key'] = 4;
                elseif($pk_name==='_kf_ConditionalFormID')
                    $datas['fk_key'] = 5;
                elseif($pk_name==='_kf_PrivilegeSetID')
                    $datas['fk_key'] = 6;
                elseif($pk_name==='_kf_PrivilegeSet_Record_FieldID')
                    $datas['fk_key'] = 7;
                elseif($pk_name==='_kf_PrivilegeSet_RecordID')
                    $datas['fk_key'] = 8;
                elseif($pk_name==='_kf_CustomMenuItem')
                    $datas['fk_key'] = 9;
                elseif($pk_name==='_kf_CustomMenu')
                    $datas['fk_key'] = 10;
                elseif($pk_name==='_kf_CustomFunction')
                    $datas['fk_key'] = 11;
                elseif($pk_name==='_kf_StepID')
                    $datas['fk_key'] = 12;
                elseif($pk_name==='_kf_TriggerID')
                    $datas['fk_key'] = 13;

                $table='XMLCalculation';

                if($first)
                    $this->FillStatus($table, 'FIRST');

                $first=FALSE;

                $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

                if (array_key_exists('last_id', $result['data']))
                {
                    $display_pk = $result['data']['last_id'];//var_dump($array->Field[$f]);print '<br><br>';
                } else
                    print $result['error_msg'];
            }
            if ($key == 'DisplayCalculation')
            {
                $this->Loop_Chunk($val, $display_pk);
            }

            if ($val->count())
            {
                $parent_tag = $key;//print 'parent_key: '.$parent_tag.' '.'<br>';
            }
            $arr_fields = $this->Loop_Calculation($val, $pk, $pk_name, $chain, $str_fields, $parent_tag, $file_pk);
            $str_fields = $arr_fields[0];
            $fields = $arr_fields[1];
        }
    }
    //----------Calculation----------

    //----------Chunk----------
    function Loop_Chunk($array, $display_pk)
    {
        $my_instance =& get_instance();
        $tag_included = array();
        $tag_excluded = array();
        $start_tag_name = array('Chunk');
        $arr_fields = $this->Loop_tags($array, $start_tag_name, $tag_excluded, $tag_included, 0, '', array(), 1, 0);

        $str_fields = $arr_fields[0];//echo 'kkkk'.$str_fields;//die();
        $array_fields = $arr_fields[1];

        $first=TRUE;

        $cant_c = sizeof($array_fields);//echo 'cant_chunk: '.$cant_c.'<br><br><br><br>';
        for ($c = 0; $c < $cant_c; $c++)
        {
            $return_arr = $this->Split_StringIntoArrays($array_fields[$c]);

            $fields = $return_arr[0];
            $datas = $return_arr[1];

            $fields[] = '_kf_DisplayID';
            $datas['_kf_DisplayID'] = $display_pk;

            $table='XMLChunks';

            if($first)
                $this->FillStatus($table, 'FIRST');

            $first=FALSE;

            $result = $my_instance->M_XML->Execute('INSERT', $fields, $datas, $table);

            if (array_key_exists('last_id', $result['data']))
            {
                //$field_pk=$result['data']['last_id'];
            } else
                print $result['error_msg'];


            //echo $array_fields[$c] . '<br>/---------------------------------------/<br>';
        }
    }
    //----------Chunk----------


    function FillStatus($table, $action)
    {
//        $my_instance =& get_instance();
//        date_default_timezone_set('America/New_York');
//        $date=date('H:i:s');
//        session_write_close();
//        /*$myfile = fopen("progress.txt", "w"); //or die("Unable to open file!");
//        fwrite($myfile, $insert_table);
//        fclose($myfile);*/
//        if($action=='FIRST')
//        {
//            $insert_table = $date.' Inserting on: '.substr($table, 3);
//            //$my_instance->db->query("CALL Insert_Status_Progress('" . $_SESSION['analisys_pk'] . "', '" . $insert_table . "')");
//        }
//

    }


}