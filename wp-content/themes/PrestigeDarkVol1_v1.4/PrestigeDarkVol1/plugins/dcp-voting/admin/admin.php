<?php
/**********************************************************************
* DIGITAL CAVALRY WP VOTING SYSTEM PLUGIN 
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

class dcpVotingAdmin
{
    /*********************************************************** 
    * Constructor
    ************************************************************/      
    
    public function __construct()
    {  
       $this->loadDefaultOptions();
        
        $this->_options = get_option(DC_VOTING_SYSTEM_OPT);
        if (!is_array($this->_options))
        {            
            add_option(DC_VOTING_SYSTEM_OPT, $this->_optionsDef);
            $this->_options = get_option(DC_VOTING_SYSTEM_OPT);
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
    private $_optionsDef = Array(); 
   
    private $_navigaton = Array(
        'General' => 'dc-voting'
     //   'Votes' => 'dc-voting-votes'
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
        add_menu_page('Digital Cavalry Voting System', 'DC Voting', 10, 'dc-voting', array(&$this, 'generalOptions')); // DCP_VOTING_URL.'img/process.png');
        add_submenu_page('dc-voting', 'Digital Cavalry Voting System', 'General', 10, 'dc-voting', array(&$this, 'generalOptions'));
     //   add_submenu_page('dc-voting', 'Digital Cavalry Voting System', 'Votes', 10, 'dc-voting-votes', array(&$this, 'votesOptions'));          
    } // adminMenu     
            
    public function generalOptions()
    {
        require_once(DCP_VOTING_DIR.'lib/dbconfig.php'); 
        
        echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>
        <h2>DC Voting System - General</h2>';
        
        $this->renderNavigation('General');
        $this->processGeneral();
        $this->renderGeneral();
        
        echo '</div>';
    }
    
    public function votesOptions()
    {
        echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>
        <h2>DC Voting System - Votes</h2>';
        
        $this->renderNavigation('Votes'); 
        
        echo '</div>';
    }    
    
    public function loadAdminScripts() 
    {
        wp_register_script($this->_pluginName.'_admin_js', DCP_VOTING_URL.'admin/js/admin.js', array('jquery'), ''); 
        
        wp_enqueue_script('jquery'); 
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');        
        wp_enqueue_script($this->_pluginName.'_admin_js');                              
    }            
    
    public function loadAdminStyles() 
    {
        wp_enqueue_style('thickbox');
        wp_enqueue_style($this->_pluginName.'_admin_css', DCP_VOTING_URL.'admin/css/admin.css', false);
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
        $this->_optionsDef['starhover'] = DCP_VOTING_URL.'img/_starhover.png';
        $this->_optionsDef['star'] = DCP_VOTING_URL.'img/_star.png';
        $this->_optionsDef['star1'] = DCP_VOTING_URL.'img/_star1.png';
        $this->_optionsDef['star2'] = DCP_VOTING_URL.'img/_star2.png';
        $this->_optionsDef['star3'] = DCP_VOTING_URL.'img/_star3.png';
        $this->_optionsDef['starb'] = DCP_VOTING_URL.'img/_starb.png';
        $this->_optionsDef['post_exp_seconds'] = 30;
        $this->_optionsDef['post_exp_minutes'] = 0;
        $this->_optionsDef['post_exp_hours'] = 0;
        $this->_optionsDef['post_exp_days'] = 0;
        $this->_optionsDef['comment_exp_seconds'] = 30;
        $this->_optionsDef['comment_exp_minutes'] = 0;
        $this->_optionsDef['comment_exp_hours'] = 0;
        $this->_optionsDef['comment_exp_days'] = 0;        
        $this->_optionsDef['show_post_voting_stats'] = true;
        $this->_optionsDef['check_comment_author_ip'] = true;        
    }    
    
    private function processGeneral()
    {
        // comments
        if(isset($_POST['cms_voting_save_comment_exp_time']))
        {
             $this->_options['comment_exp_seconds'] = $_POST['comment_exp_seconds'];
             $this->_options['comment_exp_minutes'] = $_POST['comment_exp_minutes']; 
             $this->_options['comment_exp_hours'] = $_POST['comment_exp_hours']; 
             $this->_options['comment_exp_days'] = $_POST['comment_exp_days'];    
             
             update_option(DC_VOTING_SYSTEM_OPT, $this->_options);
             $this->_saved = true; 
        }        
        
        // posts
        if(isset($_POST['cms_voting_save_post_exp_time']))
        {
             $this->_options['post_exp_seconds'] = $_POST['post_exp_seconds'];
             $this->_options['post_exp_minutes'] = $_POST['post_exp_minutes']; 
             $this->_options['post_exp_hours'] = $_POST['post_exp_hours']; 
             $this->_options['post_exp_days'] = $_POST['post_exp_days'];    
             
             update_option(DC_VOTING_SYSTEM_OPT, $this->_options);
             $this->_saved = true; 
        }                
        
        if(isset($_POST['cms_voting_save_stars_paths']))
        {
             $this->_options['starhover'] = $_POST['dcp_hover_star_path'];
             $this->_options['star'] = $_POST['dcp_full_star_path'];
             $this->_options['star1'] = $_POST['dcp_quarter_star_path']; 
             $this->_options['star2'] = $_POST['dcp_half_star_path']; 
             $this->_options['star3'] = $_POST['dcp_three_fourths_star_path']; 
             $this->_options['starb'] = $_POST['dcp_empty_star_path'];
             
             update_option(DC_VOTING_SYSTEM_OPT, $this->_options);
             $this->_saved = true; 
        }
        
        if(isset($_POST['cms_voting_save_other_options']))
        {
           $this->_options['show_post_voting_stats'] = isset($_POST['show_post_voting_stats']) ? true : false; 
           $this->_options['check_comment_author_ip'] = isset($_POST['check_comment_author_ip']) ? true : false; 
           
           update_option(DC_VOTING_SYSTEM_OPT, $this->_options);
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
        
        // Star images for star voting
        // *************************** 
        echo '<h6 class="cms-h6">Star images</h6><hr class="cms-hr" />'; 
        
        echo '<form action="#" method="post">';
        echo '<table>';
        
        // hover star       
        $out = '<tr>';
        $out .= '<td>Hover star</td>'; 
        $out .= '<td style="padding-left:10px;padding-right:10px;"><img src="'.$this->_options['starhover'].'" /></td>';
        $out .= '<td><input style="width:400px;" type="text" name="dcp_hover_star_path" id="dcp_hover_star_path" value="'.$this->_options['starhover'].'" /> ';
        $out .= '<input class="cms-upload upload_image_button" type="button" value="Upload Image" name="dcp_hover_star_path" /></td>';
        $out .= '</tr>';
        echo $out;   
        
        // full star
        $out = '<tr>';
        $out .= '<td>Full star</td>';         
        $out .= '<td style="padding-left:10px;padding-right:10px;"><img src="'.$this->_options['star'].'" /></td>'; 
        $out .= '<td><input style="width:400px;" type="text" name="dcp_full_star_path" id="dcp_full_star_path" value="'.$this->_options['star'].'" /> ';
        $out .= '<input class="cms-upload upload_image_button" type="button" value="Upload Image" name="dcp_full_star_path" /></td>';        
        $out .= '</tr>';
        echo $out;         
        
        // Quarter star
        $out = '<tr>';
        $out .= '<td>One fourth</td>';         
        $out .= '<td style="padding-left:10px;padding-right:10px;"><img src="'.$this->_options['star1'].'" /></td>';
        $out .= '<td><input style="width:400px;" type="text" name="dcp_quarter_star_path" id="dcp_quarter_star_path" value="'.$this->_options['star1'].'" /> ';
        $out .= '<input class="cms-upload upload_image_button" type="button" value="Upload Image" name="dcp_quarter_star_path" /></td>'; 
        $out .= '</tr>';
        echo $out;

        // Half star
        $out = '<tr>';
        $out .= '<td>Two fourth</td>';         
        $out .= '<td style="padding-left:10px;padding-right:10px;"><img src="'.$this->_options['star2'].'" /></td>';
        $out .= '<td><input style="width:400px;" type="text" name="dcp_half_star_path" id="dcp_half_star_path" value="'.$this->_options['star2'].'" /> ';
        $out .= '<input class="cms-upload upload_image_button" type="button" value="Upload Image" name="dcp_half_star_path" /></td>'; 
        $out .= '</tr>';
        echo $out;

        // Three fourths
        $out = '<tr>';
        $out .= '<td>Three fourth</td>';         
        $out .= '<td style="padding-left:10px;padding-right:10px;"><img src="'.$this->_options['star3'].'" /></td>';
        $out .= '<td><input style="width:400px;" type="text" name="dcp_three_fourths_star_path" id="dcp_three_fourths_star_path" value="'.$this->_options['star3'].'" /> ';
        $out .= '<input class="cms-upload upload_image_button" type="button" value="Upload Image" name="dcp_three_fourths_star_path" /></td>'; 
        $out .= '</tr>';
        echo $out;

        // Empty star
        $out = '<tr>';
        $out .= '<td>Empty star</td>';         
        $out .= '<td style="padding-left:10px;padding-right:10px;"><img src="'.$this->_options['starb'].'" /></td>';
        $out .= '<td><input style="width:400px;" type="text" name="dcp_empty_star_path" id="dcp_empty_star_path" value="'.$this->_options['starb'].'" /> ';
        $out .= '<input class="cms-upload upload_image_button" type="button" value="Upload Image" name="dcp_empty_star_path" /></td>'; 
        $out .= '</tr>';
        echo $out;
                           
        echo '</table>';
        
        $out  = '<div class="cms-add-info">You can use here JPG, PNG or GIF file format (16x16 px).</div>';
        $out .= '<div class="cms-small-separator"></div>';
        $out .= '<input class="cms-submit" type="submit" value="Save" name="cms_voting_save_stars_paths" />'; 
        echo $out;       
        echo '</form>';
       
       
       
        // Post voting cookie expire time
        // ******************************
        echo '<div class="cms-separator"></div>';
        echo '<h6 class="cms-h6">Post voting expire time</h6><hr class="cms-hr" />';
        
        $out = '<form action="#" method="post">';
        $out .= '<table>';         
        $out .= '<tr><td style="padding-right:10px;">Seconds</td><td><input style="width:60px;text-align:center;" type="text" value="'.$this->_options['post_exp_seconds'].'" name="post_exp_seconds" /></td></tr>';
        $out .= '<tr><td style="padding-right:10px;">Minuts</td><td><input style="width:60px;text-align:center;" type="text" value="'.$this->_options['post_exp_minutes'].'" name="post_exp_minutes" /></td></tr>';
        $out .= '<tr><td style="padding-right:10px;">Hours</td><td><input style="width:60px;text-align:center;" type="text" value="'.$this->_options['post_exp_hours'].'" name="post_exp_hours" /></td></tr>';
        $out .= '<tr><td style="padding-right:10px;">Days</td><td><input style="width:60px;text-align:center;" type="text" value="'.$this->_options['post_exp_days'].'" name="post_exp_days" /></td></tr>';
        $out .= '</table>';
        $out .= '<div class="cms-add-info">Total expire time is are sum of second, minuts, hours and days.</div>';
        
        $out .= '<div class="cms-small-separator"></div>';
        $out .= '<input class="cms-submit" type="submit" value="Save" name="cms_voting_save_post_exp_time" />';        
        
        $out .= '</form>';
        echo $out;
        
        // Comment voting cookie expire time
        // ******************************
        echo '<div class="cms-separator"></div>';
        echo '<h6 class="cms-h6">Comment voting expire time</h6><hr class="cms-hr" />';
        
        $out = '<form action="#" method="post">';
        $out .= '<table>';         
        $out .= '<tr><td style="padding-right:10px;">Seconds</td><td><input style="width:60px;text-align:center;" type="text" value="'.$this->_options['comment_exp_seconds'].'" name="comment_exp_seconds" /></td></tr>';
        $out .= '<tr><td style="padding-right:10px;">Minuts</td><td><input style="width:60px;text-align:center;" type="text" value="'.$this->_options['comment_exp_minutes'].'" name="comment_exp_minutes" /></td></tr>';
        $out .= '<tr><td style="padding-right:10px;">Hours</td><td><input style="width:60px;text-align:center;" type="text" value="'.$this->_options['comment_exp_hours'].'" name="comment_exp_hours" /></td></tr>';
        $out .= '<tr><td style="padding-right:10px;">Days</td><td><input style="width:60px;text-align:center;" type="text" value="'.$this->_options['comment_exp_days'].'" name="comment_exp_days" /></td></tr>';
        $out .= '</table>';
        $out .= '<div class="cms-add-info">Total expire time is are sum of second, minuts, hours and days.</div>';
        
        $out .= '<div class="cms-small-separator"></div>';
        $out .= '<input class="cms-submit" type="submit" value="Save" name="cms_voting_save_comment_exp_time" />';        
        
        $out .= '</form>';
        echo $out;        
        
        // Other options               
        // ******************************
        echo '<div class="cms-separator"></div>';
        echo '<h6 class="cms-h6">Other options</h6><hr class="cms-hr" />';        
        
        $out = '<form action="#" method="post">';  
        
        $out .= '<input type="checkbox" name="show_post_voting_stats" '.($this->_options['show_post_voting_stats'] ? ' checked="checked" ' : '').' /> Show post voting statistics<br />';
        $out .= '<input type="checkbox" name="check_comment_author_ip" '.($this->_options['check_comment_author_ip'] ? ' checked="checked" ' : '').' /> Check comment author IP';
                 
        $out .= '<div class="cms-small-separator"></div>';
        $out .= '<input class="cms-submit" type="submit" value="Save" name="cms_voting_save_other_options" />';                
        $out .= '</form>';
        echo $out;       
       
        echo '<div class="cms-separator"></div>'; 
        echo '</div>';
        
    }      
        
} // class












?>
