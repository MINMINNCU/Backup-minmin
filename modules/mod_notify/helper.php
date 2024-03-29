<?php
/**
 * @package         notify.Module
 * @subpackage      mod_notify
 * @copyright       Copyright (C) 2014 minmin.com, Inc. All rights reserved.
 * @license         GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

class modNotifyHelper
{
    public static function getNotice(&$params)
    {
        // init db
        // ===========================================================================
        $db     = JFactory::getDbo();
        
        
        // get Joomla! API
        // ===========================================================================
        // $app     = JFactory::getApplication() ;
        $user    = JFactory::getUser() ;
        // $date    = JFactory::getDate( 'now' , JFactory::getConfig()->get('offset') ) ;
        // $uri     = JFactory::getURI() ;
        // $doc     = JFactory::getDocument();
                
        $db->setQuery('SELECT * FROM `#__notify` WHERE `to_id`='.$user->id);
        $notice=$db->loadObjectlist();
        return $notice;
    }
    public static function getItem(&$params)
    {
        $user    = JFactory::getUser() ;  
        $db     = JFactory::getDbo();
        $db->setQuery('SELECT * FROM `#__k2_items` WHERE `created_by`='.$user->id);  
        $objs=$db->loadObjectlist();
        foreach ($objs as $i => $obj) {
            $items[$i][title]=$obj->title;
            
            $db->setQuery('SELECT * FROM `#__quotation` WHERE `article_id`='.$obj->id);
            $quotations=$db->loadObjectlist();
            $items[$i][Qcount]=sizeof($quotations);
            
            $db->setQuery('SELECT * FROM `#__comment` WHERE `contentid`='.$obj->id);
            $comments=$db->loadObjectlist();
            $items[$i][Tcount]=sizeof($comments);
        }
        
        return $items;
    }
    public static function notify($userId,$content){

    }
    
}
