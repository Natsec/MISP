<?php
    $data = Hash::extract($row, $field['data_path']);
    if (is_array($data)) {
        if (count($data) > 1) {
            $data = implode(', ', $data);
        } else {
            if (count($data) > 0) {
                $data = $data[0];
            } else {
                $data = '';
            }
        }
    }
    if (empty($data) && !empty($field['empty'])) {
        $data = $field['empty'];
    }
    if (is_numeric($data)) {
        $data = date('Y-m-d H:i:s', $data);
    } else {
        $data = h($data);
    }
    if (!empty($field['onClick'])) {
        $data = sprintf(
            '<span onClick="%s">%s</span>',
            $field['onClick'],
            $data
        );
    }
    echo $data;

