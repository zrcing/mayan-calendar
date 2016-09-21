<?php
/**
 * @author Liao Gengling <liaogling@gmail.com>
 */
namespace Deer\MayanCalendar;

interface MayanCalendarInterface
{
    /**
     * 
     * @param string $day e.g. 1981-05-22
     */
    public function setBirthday($day);
    
    /**
     * Get person year tablet
     */
    public function getYearTablet();
    
    /**
     * Get person month tablet
     */
    public function getMonthTablet();
    
    /**
     * Get person day tablet
     */
    public function getDayTablet();
    
    /**
     * Galaxy's KIN
     */
    public function getKin();
    
    /**
     * Get person mayan color
     */
    public function getColor();
    
    /**
     * Get person mayan tonality
     */
    public function getTonality();
    
    /**
     * Get person mayan seal
     */
    public function getSeal();
}