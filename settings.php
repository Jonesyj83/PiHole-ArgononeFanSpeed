<div id="fanspeed" class="tab-pane fade<?php if($tab === "fanspeed"){ ?> in active<?php } ?>">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="box box-warning">
                                    <div class="box-header with-border">
                                        <h1 class="box-title">Current Speed/Temp</h1>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th scope="row">Temp</th>
                                                        <td colspan="3">
                                                            <?php $output = shell_exec('xxd  -s1 -l 1 /dev/shm/argonone | cut -d " " -f2'); echo hexdec($output)." °C"; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Fanspeed</th>
                                                        <td colspan="3">
                                                            <?php $output = shell_exec('xxd -l 1 /dev/shm/argonone | cut -d " " -f2'); echo hexdec($output)."%"; ?>
                                                        </td>
                                                    </tr>
                                                    <tr> 
                                                        <th scope="row">Temp/Fan 0</th>
                                                        <td>
                                                            <?php $output = shell_exec('xxd -s5 -l 1 /dev/shm/argonone | cut -d " " -f2'); echo hexdec($output)." °C"; ?>
                                                        </td>
                                                        <td>
                                                            <?php $output = shell_exec('xxd -s2 -l 1 /dev/shm/argonone | cut -d " " -f2'); echo hexdec($output)."%"; ?>

                                                        </td>
                                                    </tr>
                                                    <tr> 
                                                        <th scope="row">Temp/Fan 1</th>
                                                        <td>
                                                            <?php $output = shell_exec('xxd -s6 -l 1 /dev/shm/argonone | cut -d " " -f2'); echo hexdec($output)." °C"; ?>
                                                        </td>
                                                        <td>
                                                            <?php $output = shell_exec('xxd -s3 -l 1 /dev/shm/argonone | cut -d " " -f2'); echo hexdec($output)."%"; ?>

                                                        </td>
                                                    </tr>
                                                    <tr> 
                                                        <th scope="row">Temp/Fan 2</th>
                                                        <td>
                                                            <?php $output = shell_exec('xxd -s7 -l 1 /dev/shm/argonone | cut -d " " -f2'); echo hexdec($output)." °C"; ?>
                                                        </td>
                                                        <td>
                                                            <?php $output = shell_exec('xxd -s4 -l 1 /dev/shm/argonone | cut -d " " -f2'); echo hexdec($output)."%"; ?>

                                                        </td>
                                                    </tr>
                                                    <tr> 
                                                        <th scope="row">Target Temp</th>
                                                        <td colspan="3">
                                                            <?php $output = shell_exec('xxd -s10 -l 1 /dev/shm/argonone | cut -d " " -f2'); echo hexdec($output)." °C"; ?>
                                                        </td>
                                                    </tr>
                                                    <tr> 
                                                        <th scope="row">Fan Speed Override</th>
                                                        <td colspan="3">
                                                            <?php $output = shell_exec('xxd -s11 -l 1 /dev/shm/argonone | cut -d " " -f2'); echo hexdec($output)."%"; ?>
                                                        </td>
                                                    </tr>
                                                    <tr> 
                                                        <th scope="row">Hysteresis</th>
                                                        <td colspan="3">
                                                            <?php $output = shell_exec('xxd -s8 -l 1 /dev/shm/argonone | cut -d " " -f2'); echo hexdec($output)." °C"; ?>
                                                        </td>
                                                    </tr>
                                                    <tr> 
                                                        <th scope="row">Fan mode</th>
                                                        <td colspan="3">
                                                            <?php $output = shell_exec('xxd -s9 -l 1 /dev/shm/argonone | cut -d " " -f2'); $fmode = hexdec($output); if ($fmode == 0) $fmode = "Auto"; if ($fmode == 1) $fmode = "Off"; if ($fmode == 2) $fmode = "Manual"; if ($fmode == 3) $fmode = "Cooldown"; echo $fmode;?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <form role="form" method="post">
                                <input type="hidden" name="fanfield" value="fanspeed">
                                <input type="hidden" name="token" value="<?php echo $token ?>">
                                <div class="box box-warning">
                                    <div class="box-header with-border">
                                        <h1 class="box-title">Change Fanspeed Settings</h1>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong>Temp 0</strong>
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <input type="number" name="temp0" class="form-control" min="0" max="100" autocomplete="off" spellcheck="false" autocapitalize="none" autocorrect="off" placeholder="Temp setting 0 eg. 55">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <strong>Fanspeed 0</strong>
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <input type="number" name="fan0" class="form-control" min="10" max="100" autocomplete="off" spellcheck="false" autocapitalize="none" autocorrect="off" placeholder="Fanspeed setting 0 eg. 10">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong>Temp 1</strong>
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <input type="number" name="temp1" class="form-control" min="0" max="100" autocomplete="off" spellcheck="false" autocapitalize="none" autocorrect="off" placeholder="Temp setting 1 eg. 60">
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="col-md-6">
                                                <strong>Fanspeed 1</strong>
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <input type="number" name="fan1" class="form-control" min="10" max="100" autocomplete="off" spellcheck="false" autocapitalize="none" autocorrect="off" placeholder="Fanspeed setting 1 eg. 55">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong>Temp 2</strong>
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <input type="number" name="temp2" class="form-control" min="0" max="100" autocomplete="off" spellcheck="false" autocapitalize="none" autocorrect="off" placeholder="Temp setting 2 eg. 65">
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="col-md-6">
                                                <strong>Fanspeed 2</strong>
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <input type="number" name="fan2" class="form-control" min="10" max="100" autocomplete="off" spellcheck="false" autocapitalize="none" autocorrect="off" placeholder="Fanspeed setting 2 eg. 100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong>Hysteresis</strong>
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <input type="number" name="hysteresis" class="form-control" min="0" max="100" autocomplete="off" spellcheck="false" autocapitalize="none" autocorrect="off" placeholder="Hysteresis temp eg. 3">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong>Cooldown Mode</strong>
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <input type="number" name="cooldowntemp" class="form-control" min="0" max="100" autocomplete="off" spellcheck="false" autocapitalize="none" autocorrect="off" placeholder="Temp to reach to eg. 50">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <strong>Option Fanspeed</strong>
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <input type="number" name="cooldownfan" class="form-control" min="10" max="100" autocomplete="off" spellcheck="false" autocapitalize="none" autocorrect="off" placeholder="If not set 10% is used. eg. 20">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong>Manual Mode</strong>
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <input type="number" name="manual" class="form-control" min="10" max="100" autocomplete="off" spellcheck="false" autocapitalize="none" autocorrect="off" placeholder="Manually set fanspeed eg. 50">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="box-footer clearfix">
                                                <input type="hidden" name="fanfield" value="fanspeed">
                                            <input type="hidden" name="token" value="<?php echo $token ?>">
                                                <button type="submit" class="btn btn-primary pull-right">Save</button>
                                            </div>
                                        </div>
                                </div>
                                </form>

                            </div>
                            <div class="row">
                        <div class="col-md-12">
                            <div class="box box-warning">
                                <div class="box-body">
                            <div class="row">
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-success confirm-fanauto btn-block">Argononed Auto</button>
                                        </div>
                                        <p class="hidden-md hidden-lg"></p>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-warning confirm-fanoff btn-block">Argononed Off</button>
                                        </div>
                                        <p class="hidden-md hidden-lg"></p>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-danger confirm-clearfandb btn-block">Clear Database</button>
                                        </div>
                                    </div>
                                    <form role="form" method="post" id="fanautoform">
                                            <input type="hidden" name="fanfield" value="fanauto">
                                            <input type="hidden" name="token" value="<?php echo $token ?>">
                                    </form>
                                    <form role="form" method="post" id="fanoffform">
                                            <input type="hidden" name="fanfield" value="fanoff">
                                            <input type="hidden" name="token" value="<?php echo $token ?>">
                                    </form>
                                    <form role="form" method="post" id="clearfandbform">
                                            <input type="hidden" name="fanfield" value="clearfandb">
                                            <input type="hidden" name="token" value="<?php echo $token ?>">
                                    </form>
                                </div>
                            </div>
                        </div>
                            </div>
                        </div>
                </div>

