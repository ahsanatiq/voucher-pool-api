<?php

if (!function_exists('loadEnvironmentFromFile')) {
    function loadEnvironmentFromFile($file)
    {
        return (new \Dotenv\Dotenv(dirname($file), basename($file)))->overload();
    }
}

if (!function_exists('parseCliArguments')) {
    function parseCliArguments($noopt = [])
    {
        $result = [];
        if (!isset($GLOBALS['argv'])) {
            return [];
        }
        $params = $GLOBALS['argv'];
        reset($params);
        while (list($tmp, $p) = each($params)) {
            // $result = processParam($tmp, $p, $noopt);
            $pResult = processParam($p);
            if (!empty($pResult[0])) {
                $pname = $pResult[0];
                $value = $pResult[1];
                $nextparm = current($params);
                $value2 = checkPResult($pname, $noopt, $value, $nextparm);
                $value = $value2 ?: $value;
                $result[$pname] = $value;
            } else {
                $result[] = $p;
            }
        }
        return $result;
    }

    function checkPResult($pname, $noopt, $value, $nextparm)
    {
        $value = '';
        if (!in_array($pname, $noopt) && $value === true && $nextparm !== false && $nextparm{0} != '-') {
            list($tmp, $value) = each($params);
        }
        return $value;
    }

    function processParam($p)
    {
        $result = [];
        $pname = '';
        $value = true;
        if ($p{0} == '-') {
            $pname = substr($p, 1);
        }
        if (!empty($pname) && $pname{0} == '-') {
            // long-opt (--<param>)
            $pname = substr($pname, 1);
            if (strpos($p, '=') !== false) {
                    // value specified inline (--<param>=<value>)
                list($pname, $value) = explode('=', substr($p, 2), 2);
            }
        }
        return [$pname, $value];
    }
}
