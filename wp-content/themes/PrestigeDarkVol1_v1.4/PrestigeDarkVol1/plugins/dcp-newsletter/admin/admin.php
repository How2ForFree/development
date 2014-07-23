<?php
/**********************************************************************
* DIGITAL CAVALRY WP NEWSLETTER SYSTEM PLUGIN 
* (WP voting system)   
* 
* File name:   
*      admin.php
* Brief:       
*      Plugin admin panel
* Author:      
*      DigitalCavalry
* Author URI:
*      http://themeforest.net/user/DigitalCavalry
* Contact:
*      digitalcavalry@gmail.com 
**********************************************************************/

class dcpNewsletterAdmin
{
    /*********************************************************** 
    * Constructor
    ************************************************************/      
    
    public function __construct()
    {  
       $this->loadDefaultOptions();
        
        $this->_options = get_option(DC_NEWSLETTER_SYSTEM_OPT);
        if (!is_array($this->_options))
        {            
            add_option(DC_NEWSLETTER_SYSTEM_OPT, $this->_optionsDef);
            $this->_options = get_option(DC_NEWSLETTER_SYSTEM_OPT);
        }        
        
        if(is_admin())
        {                                           
            add_action('admin_print_scripts', array(&$this, 'loadAdminScripts'));
            add_action('admin_print_styles', array(&$this, 'loadAdminStyles'));                  
            add_action('admin_menu', array(&$this, 'adminMenu'));                     
        }       
    }
    
    /*********************************************************** 
    * Public members
    ************************************************************/ 
    
    public $_options = Array();     

    /*********************************************************** 
    * Private members
    ************************************************************/   
    private $_saved = false;
    private $_optionsDef = Array(
        'selected_meta' => '',
        'use_meta' => false
        ); 
   
    private $_navigaton = Array(
        'General' => 'dc-newsletter'
    );     
   
    /*********************************************************** 
    * Public functions
    ************************************************************/
    
    public function getOptions()
    {
        return $this->_options;
    }
    
    public function adminMenu() 
    {
        add_menu_page('Digital Cavalry Newsletter System', 'DC Newsletter', 10, 'dc-newsletter', array(&$this, 'generalOptions')); // DCP_NEWSLETTER_URL.'img/process.png');
        add_submenu_page('dc-newsletter', 'Digital Cavalry Newsletter System', 'General', 10, 'dc-newsletter', array(&$this, 'generalOptions'));        
    } // adminMenu     
            
    public function generalOptions()
    {
        require_once(DCP_NEWSLETTER_DIR.'lib/dbconfig.php'); 
        
        echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>
        <h2>DC Newsletter System - General</h2>';
        
        $this->renderNavigation('General');
        $this->processGeneral();
        $this->renderGeneral();
        
        echo '</div>';
    } 
    
    public function loadAdminScripts() 
    {
        wp_register_script($this->_pluginName.'_admin_js', DCP_NEWSLETTER_URL.'admin/js/admin.js', array('jquery'), ''); 
        
        wp_enqueue_script('jquery'); 
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');        
        wp_enqueue_script($this->_pluginName.'_admin_js');                              
    }            
    
    public function loadAdminStyles() 
    {
        wp_enqueue_style('thickbox');
        wp_enqueue_style($this->_pluginName.'_admin_css', DCP_NEWSLETTER_URL.'admin/css/admin.css', false);
    }      
    
    /*********************************************************** 
    * Private functions
    ************************************************************/  
    
    private function renderNavigation($selected=null)
    {
        $out = '';
         $out .= '    
        <div id="cms-tabs">
            <ul>';
            foreach($this->_navigaton as $key => $value)
            {
                $out .= '<li ';
                if($selected !== null)
                {
                    if($selected == $key)
                    {
                       $out .= ' class="cms-tabs-selected" '; 
                    }
                } 
                $out .= ' ><a href="'.admin_url().'admin.php?page='.$value.'">'.$key.'</a></li>';  
            }
            $out .= '</ul>
            <div style="clear:both;margin-bottom:0px;height:15px;"></div><hr class="cms-hr"/></div>';
            
          echo $out;           
    } 
    
    private function loadDefaultOptions()
    {
        $this->_optionsDef['input_label'] = 'Your email here';
        $this->_optionsDef['btn_register'] = 'Register';
        $this->_optionsDef['btn_unregister'] = 'Unregister';
        $this->_optionsDef['msg_registered'] = 'You have bean registerd. Thank you.';
        $this->_optionsDef['msg_unregistered'] = 'You have bean unregisterd. Thank you.';
        
        $this->_optionsDef['msg_error'] = 'There was an error, please try later.';
        $this->_optionsDef['msg_cant_find'] = 'You are not registered.';
        $this->_optionsDef['msg_already'] = 'You are already registered.';           
    }    
    
    private function processGeneral()
    {
 
        if(isset($_POST['cms_newsletter_save_labels']))
        {
            $this->_options['input_label'] = $_POST['input_label'];
            $this->_options['btn_register'] = $_POST['btn_register'];
            $this->_options['btn_unregister'] = $_POST['btn_unregister'];
            $this->_options['msg_registered'] = $_POST['msg_registered'];
            $this->_options['msg_unregistered'] = $_POST['msg_unregistered'];
            
            $this->_options['msg_error'] =  $_POST['msg_error']; 
            $this->_options['msg_cant_find'] = $_POST['msg_cant_find'];
            $this->_options['msg_already'] = $_POST['msg_already'];            
           
           update_option(DC_NEWSLETTER_SYSTEM_OPT, $this->_options);
           $this->_saved = true; 
        }       
        
        if(isset($_POST['cms_newsletter_save_meta']))
        {
           $this->_options['selected_meta'] = trim($_POST['selected_meta']); 
           $this->_options['use_meta'] = isset($_POST['use_meta']) ? true : false; 
            
           update_option(DC_NEWSLETTER_SYSTEM_OPT, $this->_options);
           $this->_saved = true;             
        }   
        
        if(isset($_POST['cms_newsletter_delete_row']))
        {
           $meta  = $_POST['meta'];
           global $wpdb;
           $data = null;
           $data = $wpdb->get_results($wpdb->prepare("DELETE FROM $wpdb->dcp_newsletter WHERE meta = '".$meta."' ")); 
            var_dump($data);         
           $this->_saved = true;             
        }           
             
        
    }
    
    private function renderGeneral()
    {    
        echo '<div class="cms-content-wrapper">';
        
        if($this->_saved)
        {                    
            echo '<span class="cms-saved-bar">Settings saved</span><br /><br />';            
        }         
        
        // Newsletter widget text labels 
        $out = '';
        $out .= '<a name="text_labels"></a>';
        $out .= '<h6 class="cms-h6">Widget text labels</h6><hr class="cms-hr" />'; 
        $out .= '<form action="#text_labels" method="post">';

        $out .= '<input type="text" style="width:300px;" name="input_label" value="'.$this->_options['input_label'].'" /> Input label<br />';         
        $out .= '<input type="text" style="width:300px;" name="btn_register" value="'.$this->_options['btn_register'].'" /> Register button name<br />'; 
        $out .= '<input type="text" style="width:300px;" name="btn_unregister" value="'.$this->_options['btn_unregister'].'" /> Unregister button name<br />'; 
        $out .= '<input type="text" style="width:300px;" name="msg_registered" value="'.$this->_options['msg_registered'].'" /> Registered message<br />';         
        $out .= '<input type="text" style="width:300px;" name="msg_unregistered" value="'.$this->_options['msg_unregistered'].'" /> Unregistered message<br />'; 
        $out .= '<input type="text" style="width:300px;" name="msg_error" value="'.$this->_options['msg_error'].'" /> Error message<br />'; 
        $out .= '<input type="text" style="width:300px;" name="msg_cant_find" value="'.$this->_options['msg_cant_find'].'" /> Can\'t find message<br />';
        $out .= '<input type="text" style="width:300px;" name="msg_already" value="'.$this->_options['msg_already'].'" /> Already registered message<br />';
                 
        $out .= '<div class="cms-small-separator"></div>';
        $out .= '<input class="cms-submit" type="submit" value="Save" name="cms_newsletter_save_labels" />';                  
        $out .= '</form>';    
        echo $out;
        
        $out = '';
        $out .= '<div style="height:30px;"></div>';
        $out .= '<a name="emails"></a>';
        $out .= '<h6 class="cms-h6">Subscribers statistics</h6><hr class="cms-hr" />';
        $out .= '<h6 class="cms-add-info">Created newsletters:</h6>'; 
        
        global $wpdb;
        $data = null;
        $data = $wpdb->get_results($wpdb->prepare("SELECT meta, COUNT(*) as count FROM $wpdb->dcp_newsletter GROUP BY meta"));
        
        $count = count($data);
        if($count > 0)
        {
            $out .= '<table class="widefat">';
                $out .= '<thead>
                        <tr>
                            <th>No</th>
                            <th>Newsletter meta</th>
                            <th>Subscribers</th>
                            <th>Delete</th> 
                        </tr>
                      </thead>';
                      
                foreach($data as $key => $m)
                {
                    $out .= '<tr>
                                <td>'.($key+1).'</td>
                                <td>'.$m->meta.'</td>
                                <td>'.$m->count.'</td>
                                <td>'.'<form action="#emails" method="post"><input type="hidden" value="'.$m->meta.'" name="meta" /><input onclick="return confirm('.
                                    "'Delete row? All emails with given meta will be deleted!'".
                                    ')" class="cms-submit-delete" type="submit" value="Delete" name="cms_newsletter_delete_row" /></form>'.'</td>
                             </tr>';    
                }                  
            $out .= '</table>';    
        } else
        {
            $out .= '<h6 class="cms-add-info" style="color:#880000;">There ara no registered emails.</h6>';
        }
        
        
        $where = '';
        if($this->_options['use_meta']) { $where = ' WHERE meta = \''.$this->_options['selected_meta'].'\' '; }        
        $data = $wpdb->get_results($wpdb->prepare("SELECT DISTINCT email FROM $wpdb->dcp_newsletter".$where));
        
        $counter = 0;
        $emails_list = '';
        foreach($data as $email)
        {
            if($counter > 0)
            {
                $emails_list .= ';';    
            }
            $emails_list .= $email->email;
            $counter++;    
        }
         
        $out .= '<br /><form action="#emails" method="post">';            
        
        $out .= '<input type="checkbox" name="use_meta" '.($this->_options['use_meta'] ? ' checked="checked" ' : '').' /> Display emails by meta<br /><br />';
        $out .= '<input type="text" style="width:200px;" name="selected_meta" value="'.$this->_options['selected_meta'].'" /> Meta name<br /><br /> '; 
        $out .= '<input class="cms-submit" type="submit" value="Search emails" name="cms_newsletter_save_meta" /><br />';
                           
        $out .= '</form>';
        $out .= '<div class="cms-small-separator"></div>'; 
        
        $out .= '<h6 class="cms-add-info">Emails list:</h6>';            
        $out .= '<textarea style="width:700px;height:300px;padding:5px;font-size:11px;color:#444444;">'.$emails_list.'</textarea><br />';
        echo $out;        
        
        echo '<div class="cms-separator"></div>'; 
        echo '</div>';        
    }      
        
} // class












?>
