<?php 

function any_in_array($needle, $haystack){
    $needle = is_array($needle) ? $needle : array($needle);
    foreach ($needle as $item){
        if (in_array($item, $haystack)){
                return TRUE;
        }
    }
    return FALSE;
}

function interviewStatus($status)
{
    switch ($status) 
    {
        case '0':
            return 'Not Completed';
            break;
    
        case '1':
            return 'Completed';
            break;
    
        case '2':
            return 'Disabled';
            break;
    
        case '3':
            return 'Rejected';
            break;
    
        case '4':
            return 'Under Conversion';
            break;
    
        case '5':
            return 'Conversion In Process';
            break;
    
        case '6':
            return 'Conversion Fail';
            break;
    
        default:
            return '-';
            break;
    }
    return FALSE;
}

function interviewStatusColor($status='')
{
    switch ($status)
    {
        case '0':
            return 'notcompleted-color';
            break;
    
        case '1':
            return 'completed-color';
            break;
    
        case '2':
            return 'disabled-color';
            break;
    
        case '3':
            return 'rejected-color';
            break;
    
        case '4':
            return 'underconversion-color';
            break;
    
        case '5':
            return 'conversioninprocess-color';
            break;
    
        case '6':
            return 'conversionfail-color';
            break;
    
        default:
            return 'notcompleted-color';
            break;
    }
    return FALSE;
}

function checkAjaxStatus(){
    return array(4,5);
}

function loadCss($css){
    $cssHtml = '';
    if($css && is_array($css)){
        foreach($css as $cssInfo){
            $cssFile = base_url().$cssInfo;
            $cssFile = $cssFile.getAssetVersion(true);
            $cssHtml .= '<link rel="stylesheet" href="'.$cssFile.'">'."\n";
        }
    }
    return $cssHtml;
}

function loadJs($js){
    $jsHtml = '';
    if($js && is_array($js)){
        foreach($js as $jsInfo){
            $jsFile = base_url().$jsInfo;
            $jsFile = $jsFile.getAssetVersion(true);
            $jsHtml .= "<script type=\"text/javascript\" src=\"$jsFile\"></script>\n";
        }
    }
    return $jsHtml;
}

function getAssetVersion($v=false)
{
    $vs = (isset($_ENV['ASSET_VERSION']) && $_ENV['ASSET_VERSION']) ? $_ENV['ASSET_VERSION'] : date('Ymd');
    $vs = ($v === true) ? "?".$vs : $vs;
    return $vs;
}

