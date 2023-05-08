<?php

function generateMRF($post, $vehicleModel): bool {

    $array1 = array();
    $array2 = array();
    $array3 = array();
    $type = '';
    $flag = [true, true, true];

    foreach ($post as $key => $value) {
        if(str_contains($key, 'type')) {
            if ($value === 'M0001') {
                $array1[] = new stdClass();
                $array1[count($array1)-1]->ModelNo = $value;
                $type = 'M0001';
            } else if ($value === 'M0002') {
                $array2[] = new stdClass();
                $array2[count($array2)-1]->ModelNo = $value;
                $type = 'M0002';
            } else if ($value === 'M0003') {
                $array3[] = new stdClass();
                $array3[count($array3)-1]->ModelNo = $value;
                $type = 'M0003';
            }
        }
        if(str_contains($key, 'color')) {
            if ($type === 'M0001') {
                $array1[count($array1)-1]->Color = $value;
            } else if ($type === 'M0002') {
                $array2[count($array2)-1]->Color = $value;
            } else if ($type === 'M0003') {
                $array3[count($array3)-1]->Color = $value;
            }
        }
        if(str_contains($key, 'qty')) {
            if ($type === 'M0001') {
                $array1[count($array1)-1]->Qty = $value;
            } else if ($type === 'M0002') {
                $array2[count($array2)-1]->Qty = $value;
            } else if ($type === 'M0003') {
                $array3[count($array3)-1]->Qty = $value;
            }
        }
    }

    $data = [
        'componentRequestDetails' => [
            'M0001' => $array1,
            'M0002' => $array2,
            'M0003' => $array3
        ],
        'components' => [
            'M0001' => $vehicleModel['M0001'],
            'M0002' => $vehicleModel['M0002'],
            'M0003' => $vehicleModel['M0003']
        ]
    ];



    if ($data['componentRequestDetails']['M0001'] != null) {
        $html = createHtml($data,'M0001');
        $flag[0] = convert('M0001',$html);
    }

    if ($data['componentRequestDetails']['M0002'] != null) {
        $html = createHtml($data,'M0002');
        $flag[1] = convert('M0002',$html);
    }

    if ($data['componentRequestDetails']['M0003'] != null) {
        $html = createHtml($data,'M0003');
        $flag[2] = convert('M0003',$html);
    }

    if ($flag[0] && $flag[1] && $flag[2]) {
        return true;
    } else {
        return false;
    }

}

function createHtml($data,$type): string {

    $model = '';

    if ($type == 'M0001') {
        $model = 'Micro Panda';
        $colors = ['White' => 0, 'Black' => 0, 'Red' => 0, 'Green' => 0, 'Blue' => 0, 'Yellow' => 0, 'None' => 0];
        $headings = '<th valign="bottom" class="th col-right txt txt-nowrap bold" width="5%">
                        White
                    </th>
                    <th valign="bottom" class="th col-right txt txt-nowrap bold" width="5%">
                        Black
                    </th>
                    <th valign="bottom" class="th col-right txt txt-nowrap bold" width="5%">
                        Red
                    </th>
                    <th valign="bottom" class="th col-right txt txt-nowrap bold" width="5%">
                        Green
                    </th>
                    <th valign="bottom" class="th col-right txt txt-nowrap bold" width="5%">
                        Blue
                    </th>
                    <th valign="bottom" class="th col-right txt txt-nowrap bold" width="5%">
                        Yellow
                    </th>';
    } else {
        if ($type == 'M0002')
            $model = 'Micro Panda Cross';
        else if ($type == 'M0003')
            $model = 'MG ZS SUV';
        $colors = ['Black' => 0, 'Red' => 0, 'Green' => 0, 'Blue' => 0, 'None' => 0];
        $headings = '<th valign="bottom" class="th col-right txt txt-nowrap bold" width="5%">
                        Black
                    </th>
                    <th valign="bottom" class="th col-right txt txt-nowrap bold" width="5%">
                        Red
                    </th>
                    <th valign="bottom" class="th col-right txt txt-nowrap bold" width="5%">
                        Green
                    </th>
                    <th valign="bottom" class="th col-right txt txt-nowrap bold" width="5%">
                        Blue
                    </th>';
    }

    foreach ($data['componentRequestDetails'][$type] as $value) {
        $colors[$value->Color] = $value->Qty;
        $colors['None'] = $colors['None'] + $value->Qty;
    }

    $body = '';
    foreach ($data['components'][$type] as $value) {
        $body .= '<tr>';
        $body .= '<td valign="bottom" class="td col-right txt txt-nowrap bold">'.$value->PartNo.'</td>
                  <td valign="bottom" class="td col-right txt txt-nowrap bold">'.$value->PartName.'</td>';

        foreach ($colors as $key=>$quantity) {
            if ($key == 'None') {
                $qty = !$value->Color ? $quantity * $value->Qty : 0;
            } else {
                $qty = $value->Color ? $quantity * $value->Qty : 0;
            }
            $body .= '<td valign="bottom" class="td col-right txt txt-nowrap bold">'.$qty.'</td>';
        }
        $body .= '</tr>';
    }

    $file = file_get_contents(APP_ROOT . '\views\templates\mrf.html');
    $position = strpos($file, '<!-- Date -->');
    if ($position !== false) {
        $file = substr_replace($file, date('Y-m-d'), $position, 0);
    }
    $position = strpos($file, '<!-- Model -->');
    if ($position !== false) {
        $file = substr_replace($file, $model, $position, 0);
    }
    $position = strpos($file, '<!-- Colors -->');
    if ($position !== false) {
        $file = substr_replace($file, $headings, $position, 0);
    }
    $position = strpos($file, '<!-- Insert Point -->');
    if ($position !== false) {
        $file = substr_replace($file, $body, $position, 0);
    }

    return $file;

}