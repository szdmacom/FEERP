<?php
//单个引入
//Yii::$classMap['fecshop\app\appfront\helper\test\My'] = '@appfront/helper/My.php';
//文件方式引入
$classMap = require(__DIR__.'/ApiClasses.php');
if (is_array($classMap) && !empty($classMap)) {
    foreach ($classMap as $namespace => $filePath) {
        Yii::$classMap[$namespace] = $filePath;
    }
}
