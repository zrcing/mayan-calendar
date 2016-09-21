<?php
/**
 * @author Liao Gengling <liaogling@gmail.com>
 */
namespace Deer\MayanCalendar;

use Datetime;
use DateTimeZone;

class MayanCalendar implements MayanCalendarInterface
{
    /**
     * 
     * @var \Deer\MayanCalendar\PersonEntiry
     */
    protected $person;
    
    protected $birthdayTimezone;
    
    protected $mayanConfigs;
    
    /**
     * Setup birthday
     * 
     * @param string $day e.g. 1981-05-22
     * @param string $timezone
     */
    public function setBirthday($day, $timezone = 'PRC')
    {
        $this->birthdayTimezone = $timezone;
        $this->initPersonEnity($day);
    }
    
    protected function initPersonEnity($day)
    {
        $this->person = null;
        $this->person = new PersonEntity();
        $this->person->birthday = $day;
        
        $datetime = new Datetime($this->person->birthday, new DateTimeZone($this->birthdayTimezone));
        
        $this->person->year = $datetime->format('Y');
        $this->person->month = $datetime->format('m');
        $this->person->day = $datetime->format('d');
    }
    
    protected function mayanConfig()
    {
        if (is_null($this->mayanConfig)) {
            $this->mayanConfigs = require 'MayanConfig.php';
        }
        return $this->mayanConfigs;
    }
    
    public function getYearTablet()
    {
        if (is_null($this->person->yearTablet)) {
            
            $this->person->yearTablet = $this->mayanConfig()['yearTablet'][($this->person->year - 38) % 52];
        }
        return $this->person->yearTablet;
    }
    
    public function getMonthTablet()
    {
        if (is_null($this->person->monthTablet)) {
            $this->person->monthTablet = $this->mayanConfig()['monthTablet'][(int)$this->person->month];
        }
        return $this->person->monthTablet;
    }
    
    public function getDayTablet()
    {
        if (is_null($this->person->dayTablet)) {
            $this->person->dayTablet = (int)$this->person->day;
        }
        return $this->person->dayTablet;
    }
    
    public function getKin()
    {
        if (is_null($this->person->kin)) {
            $kin = ( $this->getYearTablet() + $this->getMonthTablet() + $this->getDayTablet() ) % 260;
            $this->person->kin = $kin == 0 ? 260 : $kin;
        }
        return $this->person->kin;
    }
    
    public function getColor()
    {
        if (is_null($this->person->color)) {
            $kin = $this->getKin();
            $greenTonality = [
                1,   22,  43,  64,  85,  106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 96,  77,  58,  39,  20, 
                241, 222, 203, 184, 165, 146, 147, 148, 149, 150, 151, 152, 153, 154, 155, 176, 197, 218, 239, 260,
                88,  69,  50,  51,  72,  93,
                168, 189, 210, 211, 192, 173
            ];
            if (in_array($kin, $greenTonality)) {
                $this->person->color = 5;
            } else {
                $this->person->color = ($a = $kin % 4) == 0 ? 4 : $a;
            }
        }
        return $this->mayanConfig()['colors'][$this->person->color];
    }
    
    public function getTonality()
    {
        if (is_null($this->person->tonality)) {
            $kin = $this->getKin();
            $this->person->tonality = ($a = $kin % 13) == 0 ? 13 : $a;
        }
        return $this->person->tonality;
    }
    
    public function getSeal()
    {
        if (is_null($this->person->seal)) {
            $kin = $this->getKin();
            $this->person->seal = ($a = $kin % 20) == 0 ? 20 : $a;
        }
        return $this->mayanConfig()['seals'][$this->person->seal];
    }
}