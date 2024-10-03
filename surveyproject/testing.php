<form method="post" style="margin-bottom:20px" class="my-4">
    <div class="container-fluid flex d-flex justify-content-center">
        <div class="card col-7 rounded-3 c_class css_border " style="border-color:aqua;border-width:2px">
            <div class="card-body p-2 p-md-3 d-flex flex-column align-items-center ">

                <div class="mb-5" style="margin-left:60px">
                    <h1><i>SURVEY</i></h1>
                </div>
                <!-- question show -->
                <div class="row col-12 mb-3 ms-2 me-2" id="parent_div ">

                    <?php
                    $l = 0;

                    foreach ($mul_arr as $s_id => $ques) {
                        foreach ($ques as $q => $opt) {
                            $l++;
                            if (!empty($q)) {
                                foreach ($opt as $k => $v) {
                                    $ques_id =  $v['ques_id'];
                                    $ques_type = $v['ques_type'];
                                }
                    ?>
                                <div class="row col-10 rounded mb-2 pt-2  parent_delete">
                                    <div class="row ms-2">
                                        <div class="col-sm-10 p-0">
                                            <div class='form-group input-group mb-3 pb-3 pt-1 css_border px-3' style="background-color:white-smoke;border-width:2px">
                                                <div class='input-group-prepend mt-1 me-2'>
                                                    <div class=''> <strong>Q.<?php echo $l; ?></strong> </div>
                                                </div>
                                                <div class="mt-1" style="word-wrap: break-word;width:90%; " disabled><?php echo $q; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $len = count($opt);
                                    $i = 0;
                                    foreach ($opt as $o => $b) {
                                        // sc************
                                        if ($b['arr_opt'] != "") {
                                            if ($b['ques_type'] == "sc") {
                                                $i++;
                                    ?>
                                                <div class='flex d-flex justify-content-start row mb-2'>
                                                    <div class='col-1' style="padding-left:30px"><input type='radio' name='options[<?php echo $b['ques_id'] ?>][]' value="<?php echo $b['arr_opt'] ?>"></div>
                                                    <div class='col-9 ps-1' style="color:black;font-family: serif;font-weight:20px"> <?php print_r($b['arr_opt']); ?></div>
                                                </div>
                                                <?php
                                                if ($i == count($opt)) {
                                                    echo " <hr class='style-eight mt-0'>";
                                                }
                                                // mcq************
                                            } elseif ($b['ques_type'] == "mcq") {
                                                $i++;
                                                ?>
                                                <div class='flex d-flex justify-content-start row mb-2'>
                                                    <div class='col-1' style="padding-left:30px"><input type='checkbox' name='options[<?php echo $b['ques_id'] ?>][]' value="<?php echo $b['arr_opt'] ?>"></div>
                                                    <div class='col-9 ps-1' style="color:black;font-family: serif;font-weight:20px"> <?php print_r($b['arr_opt']); ?></div>
                                                </div>
                                                <?php
                                                if ($i == count($opt)) {
                                                    echo " <hr class='style-eight mt-0'>";
                                                }
                                                // sc_c************
                                            } elseif ($b['ques_type'] == "sc_c") {
                                                $i++;
                                                if ($i == count($opt) && !preg_match(@$pattern, $b['arr_opt'])) { ?>

                                                    <div class='flex d-flex justify-content-start row mb-2'>
                                                        <div class='col-1' style="padding-left:30px"><input type='radio' name='options[<?php echo $b['ques_id'] ?>][]' value="<?php echo $b['arr_opt'] ?>"></div>
                                                        <div class='col-9 ps-1' style="color:black;font-family: serif;font-weight:20px"><?php print_r($b['arr_opt']); ?></div>
                                                    </div>

                                                    <div class="row col-8 ms-4 mb-2">
                                                        <textarea class="mb-2 ps-2 pt-2 rounded" placeholder="#enter text here............"></textarea>
                                                    </div>
                                                    <hr class='style-eight mt-0'>
                                                <?php  } elseif (@preg_match(@$pattern, $b['arr_opt'])) {
                                                    $str = str_replace(str_split('#*&'), '', $b['arr_opt']);
                                                ?>
                                                    <div class="row col-8 ms-4 mb-2">
                                                        <textarea class="mb-2 ps-2 pt-2 rounded" placeholder="<?php echo $str; ?>" name='options[<?php echo $b['ques_id'] ?>][]'></textarea>
                                                    </div>
                                                    <hr class='style-eight mt-0'>
                                                <?php
                                                } else { ?>
                                                    <div class='flex d-flex justify-content-start row mb-2'>
                                                        <div class='col-1' style="padding-left:30px"><input type='radio' name='options[<?php echo $b['ques_id'] ?>][]' value="<?php echo $b['arr_opt'] ?>"></div>
                                                        <div class='col-9 ps-1' style="color:black;font-family: serif;font-weight:20px"><?php print_r($b['arr_opt']); ?></div>
                                                    </div>
                                                <?php   }

                                                // mcq_c************
                                            } elseif ($b['ques_type'] == "mcq_c") {
                                                $i++;
                                                if ($i == count($opt) && !preg_match(@$pattern, $b['arr_opt'])) { ?>

                                                    <div class='flex d-flex justify-content-start row mb-2'>
                                                        <div class='col-1' style="padding-left:30px"><input type='checkbox' name='options[<?php echo $b['ques_id'] ?>][]' value="<?php echo $b['arr_opt'] ?>"></div>
                                                        <div class='col-9  ps-1' style="color:black;font-family: serif;font-weight:20px"> <?php print_r($b['arr_opt']); ?></div>
                                                    </div>

                                                    <div class="row col-8 ms-4 mb-2">
                                                        <textarea class="mb-2 ps-2 pt-2 rounded" placeholder="#enter text here............"></textarea>
                                                    </div>
                                                    <hr class='style-eight mt-0'>

                                                <?php  } elseif (@preg_match(@$pattern, $b['arr_opt'])) {
                                                    $str = str_replace(str_split('#*&'), '', $b['arr_opt']);
                                                ?>
                                                    <div class="row col-8 mt-2 ms-4 mb-2">
                                                        <textarea class="mb-2 ps-2 pt-2 rounded" placeholder="<?php echo $str; ?>" name='options[<?php echo $b['ques_id'] ?>][]'></textarea>
                                                    </div>
                                                    <hr class='style-eight mt-0'>
                                                <?php
                                                } else { ?>
                                                    <div class='flex d-flex justify-content-start row mb-2'>
                                                        <div class='col-1' style="padding-left:30px"><input type='checkbox' name='options[<?php echo $b['ques_id'] ?>][]' value="<?php echo $b['arr_opt'] ?>"></div>
                                                        <div class='col-9  ps-1' style="color:black;font-family: serif;font-weight:20px"> <?php print_r($b['arr_opt']); ?></div>
                                                    </div>
                                                <?php }
                                            }
                                        } else {
                                            if ($b['ques_type'] == "text") { ?>
                                                <div class='row-5 col-9 my-3 ms-3'>
                                                    <input type='text' placeholder='#text here' name='options[<?php echo $b['ques_id'] ?>][]' class='form-control' aria-label='Sizing example input' aria-de scribedby='inputGroup-sizing-default'>
                                                </div>
                                                <hr class='style-eight mt-0'>
                                            <?php   } elseif ($b['ques_type'] == "date") { ?>
                                                <div class='row-5 col-9 my-3 ms-3'>
                                                    <input type='date' placeholder='#text here' name='options[<?php echo $b['ques_id'] ?>][]' class='form-control' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-default'>
                                                </div>
                                                <hr class='style-eight mt-0'>
                                            <?php    } elseif ($b['ques_type'] == "time") { ?>
                                                <div class='row-5 col-9 my-3 ms-3'>
                                                    <input type='time' placeholder='#text here' name='options[<?php echo $b['ques_id'] ?>][]' class='form-control' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-default'>
                                                </div>
                                                <hr class='style-eight mt-0'>
                                            <?php   } elseif ($b['ques_type'] == "rating") { ?>
                                                <div class='row-5 col-9 my-3 ms-3' id='rating'>
                                                    <div class='col-6 ms-2'>
                                                        <label class='mt-2' for='vol'>Rate us (between 0 and 5):</label>
                                                        <input type='range' id='vol' min='0' max='5' name='options[<?php echo $b['ques_id'] ?>][]' style='width:100%;height:7vh;'>
                                                    </div>
                                                </div>
                                                <hr class='style-eight mt-0'>
                                            <?php   } elseif ($b['ques_type'] == "file") { ?>
                                                <div class='row-5 col-9 my-3 ms-3'>
                                                    <input type='file' class='form-control' name='options[<?php echo $b['ques_id'] ?>][]' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-default'>
                                                </div>
                                <?php       }
                                        }
                                    }
                                }
                                ?>
                                </div>
                        <?php

                        }
                    }
                        ?>
                </div>