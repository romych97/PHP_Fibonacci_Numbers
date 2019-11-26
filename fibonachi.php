<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style> 
    body {
    height: 100rem;
    background-color: #efefef;
    }
    .cell_ls, .cell_rs {
    background-color: #efefef;
    }
    .table_div {
    user-select: none;    
    border-bottom: 1px solid #e5e5e5;
    /* padding: 5px 5px; */
    /* background-color: #fff; */
    /* width: 730px; */
    display: flex;
    }
    .cell_div {
    line-height: 39px;
    cursor: default;
    border-right: 1px solid #e5e5e5;
    width: 130px;
    text-align: left;
    text-align: center;
    padding: 3px;
    }
    .content {
    position: relative;
    border-radius: 5px;
    border: 1px solid #d5d5d5;
    padding: 10px;
    background-color: #f6f6f6;
    }
    .inner_popUp {
    line-height: 36px;
    width: auto;
    padding: 0px 20px;
    background-color: #efefef;
    right: 10px;
    position: absolute;
    }
</style>
</head>
<body>

<div class="content">
<div style="display:none" class="inner_popUp" id="f1"></div>
<?php
function fib(): Generator {
    $a = 1;
    $b = 1;
    while (true) {
        yield $a;
        [$a, $b] = [$b, $a + $b];
    }
}
 
$n = 6;
$m = 6;
 
$array = iterator_to_array(new LimitIterator(fib(), 0, $n*$m));
$array = array_chunk($array, $n);
$aarrayrr = array_map(null, ...$array);

$l_s = 0;
$r_s = 5;
foreach ($array as $i => $value) {
    foreach ($value as $g => $v) {
            if ($g == 0) {
                echo '<div class="table_div">';
            }

            if ($g == $l_s) {
                echo '<div class="cell_div cell_ls">'. $v .'</div>';        
            } elseif ($g == $r_s) {
                echo '<div class="cell_div cell_rs">'. $v .'</div>';        
            } elseif ($l_s == $r_s) {
                echo '<div class="cell_div cell_rs cell_ls">'. $v .'</div>';        
            } else {
                echo '<div class="cell_div">'. $v .'</div>';
            }

            if ($g == 5) {
                echo '</div>';
            }
    }
  $l_s = $l_s + 1;
  $r_s = $r_s - 1;
}

?>
</div>
<script>

let left_side_cells = document.getElementsByClassName('cell_ls');
let right_side_cells = document.getElementsByClassName('cell_rs');
console.log(left_side_cells)
console.log(right_side_cells)

let output_elem_array = [];
function output(elem, color) {
    for(var i = 0; i < elem.length; i ++) {
        elem[i].style.backgroundColor = color;
        output_elem_array.push(elem[i].innerText.split(' ')[0])
        
        if (i == elem.length - 1) {
                function arraySum(array){
                var sum = 0;
                for(var i = 0; i < array.length; i++) {
                    sum += parseInt(array[i]);
                    }
                console.log(document.getElementById('f1'));
                document.getElementById('f1').innerText = 'Сумма элеметов - ' + sum
                }
            arraySum(output_elem_array);
            output_elem_array = [];
        }
    }
}
function element_handler(elem) {
    for(var i = 0; i < left_side_cells.length; i ++) {
        elem[i].onmouseover = function() {
            output(elem ,"#e9e8e8");
            document.getElementById('f1').style.display = 'block'
        };
        elem[i].onmouseout = function() {
            output(elem, "");
            document.getElementById('f1').style.display = 'none'
        };
    }
}
element_handler(left_side_cells)
element_handler(right_side_cells)
</script>
</body>
</html>