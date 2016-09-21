<?php
/**
 * @author Liao Gengling <liaogling@gmail.com>
 */
namespace Deer\MayanCalendar;

class PersonEntity
{
    /**
     * Birthday e.g. 1981-02-13
     * 
     * @var string
     */
    public $birthday;
    
    /**
     * 
     * @var number
     */
    public $year;
    
    /**
     * 
     * @var number
     */
    public $month;
    
    /**
     * 
     * @var number
     */
    public $day;
    
    /**
     * 
     * @var number
     */
    public $yearTablet;
    
    /**
     * 
     * @var number
     */
    public $monthTablet;
    
    /**
     * 
     * @var number
     */
    public $dayTablet;
    
    /**
     * 星系印记
     * @var number
     */
    public $kin;
    
    /**
     * 颜色
     * @var number
     */
    public $color;
    
    /**
     * 调性
     * @var number
     */
    public $tonality;
    
    /**
     * 图腾
     * @var number
     */
    public $seal;
}