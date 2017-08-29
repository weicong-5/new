<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/29
 * Time: 17:18
 *
 * 公共的年级类
 */

class Grade{
    const GradeOne = '一年级';
    const GradeTwo = '二年级';
    const GradeThree = '三年级';
    const GradeFour = '四年级';
    const GradeFive = '五年级';
    const GradeSix = '六年级';
    const JuniorGradeOne = '初一';
    const JuniorGradeTwo = '初二';
    const JuniorGradeThree = '初三';
    const SeniorOne = '高一';
    const SeniorTwo = '高二';
    const SeniorThree = '高三';


    static $grades = array(0=>'请选择年级',1=>self::GradeOne,2=>self::GredeOne);
}