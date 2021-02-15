<?php
include_once("inc/header.php");

if($_SESSION['loggedin'] == 0) {
    header("Location: inloggen.php?error=3");
}
$reservedappid = 0;
if(isset($_GET['appid']))
    $reservedappid=$_GET['appid'];
?>
<!-- Begin page content -->



<main class="flex-shrink-0">

<div class="container">
    <section>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bewerk reservering</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="myModal-body">
                        Osinga gaat emigreren naar Noorwegen
                    </div>
                    <div class="modal-footer">
                        <button type="reset"  form="bewerk_reservering" class="btn btn-secondary">Reset</button>
                        <button type="submit" form="bewerk_reservering" class="btn btn-primary">Bewaar</button>
                    </div>
                </div>
            </div>
        </div>
        <h1>U bent in gelogd, reserveer hier een apparaat</h1>
    </section>
<div class="accordion" id="accordionExample">

    <?php
    $dbconnect = new dbconnection();
    $sql = "SELECT * FROM apparaat";
    $query = $dbconnect -> prepare($sql);
    $query ->execute();
    $teller=1;
    while($recset = $query->fetch(PDO::FETCH_ASSOC)){
        $showclass="";
        $truefalsecollapse="false";
        //collapsed = ingeklapt
        $collapsedstate="collapsed";
        if($recset['app_id'] == $reservedappid) {
            $showclass = "show";
            $truefalsecollapse="true";
            $collapsedstate="";
        }
    ?>
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading<?=$teller?>">
            <button class="accordion-button <?= $collapsedstate ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$teller?>" aria-expanded="<?= $truefalsecollapse ?>" aria-controls="collapse<?=$teller?>">
                <?php echo $recset['app_naam']." (op te halen in: ".$recset['app_plek'].")"; ?>
            </button>
        </h2>
        <div id="collapse<?=$teller?>" class="accordion-collapse collapse <?= $showclass ?>" aria-labelledby="heading<?=$teller?>" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <table class="table table-sm table-hover">
                <?php
                //in de variabele $nu staat de datum en het tijdstip van laden van de pagina
                $nu = date('Y-m-d H:i:s');
                $sql2 = "SELECT * FROM reserveringen WHERE res_appid=:apparaatid AND (res_vanaf>:now1 OR res_tot>:now2)";
                $query2 = $dbconnect -> prepare($sql2);
                $query2->bindParam(":apparaatid", $recset['app_id']);
                $query2->bindParam(":now1", $nu);
                $query2->bindParam(":now2", $nu);
                $query2 ->execute();
                $disableddays = "";
                while($ids = $query2->fetch(PDO::FETCH_ASSOC)){
                    echo "<tr>";
                    echo "<td>Gereserveerd van</td>";
                    echo "<td>".strftime("%A %e %B %Y",strtotime($ids['res_vanaf']))."</td>";
                    echo "<td>".strftime("%H:%M uur",strtotime($ids['res_vanaf']))."</td>";
                    echo "<td>tot</td>";
                    echo "<td>".strftime("%A %e %B %Y",strtotime($ids['res_tot']))."</td>";
                    echo "<td>".strftime("%H:%M uur",strtotime($ids['res_tot']))."</td>";
                    echo "<td>";
                    if($_SESSION['user_id'] == $ids['res_userid'])
                        echo "<a class='btn btn-danger btn-sm' href='app/verwerk_wisreservering.php?resid={$ids['res_id']}&appid={$recset['app_id']}'>WIS</a>";
                    echo "</td>";
                    echo "<td>";
                    if($_SESSION['user_id'] == $ids['res_userid'])
                        echo "<button type='button' class='btn btn-info btn-sm' onclick='bewerkReservering({$ids['res_id']})'>BEWERK</button>";
                    echo "</td>";
                    echo "</tr>";

                    $dagteller=0;
                    while(strtotime($ids['res_vanaf'].' + '.$dagteller.' days') <= strtotime($ids['res_tot'])){
                        if($disableddays <> "")
                            $disableddays.=", ";
                        $disableddays.="moment('".date('m/d/Y',strtotime($ids['res_vanaf'].' + '.$dagteller.' days'))."')";
                        $dagteller++;
                    }
                }
                ?>
                </table>
                <!-- einde van de reserveringen -->
                <form method="POST" action="app/verwerk_reservering.php?appid=<?= $recset['app_id'] ?>">
                <div class="row">
                    <div class='col-3'>
                        <div class="form-group">
                            <label class="form-label"><b>Reservering vanaf</b></label>
                            <div class="input-group date" id="datetimepicker_v<?=$teller?>" data-target-input="nearest">
                                <input type="text" name="datumvanaf_<?= $recset['app_id'] ?>" class="form-control datetimepicker-input" data-target="#datetimepicker_v<?=$teller?>"/>
                                <div class="input-group-append" data-target="#datetimepicker_v<?=$teller?>" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="bi-calendar-week"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='col-3'>
                        <div class="form-group">
                            <label class="form-label"><b>Reservering tot</b></label>
                            <div class="input-group date" id="datetimepicker_t<?=$teller?>" data-target-input="nearest">
                                <input type="text" name="datumtot_<?= $recset['app_id'] ?>" class="form-control datetimepicker-input" data-target="#datetimepicker_t<?=$teller?>"/>
                                <div class="input-group-append" data-target="#datetimepicker_t<?=$teller?>" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="bi-calendar-week"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <label class="form-label">&nbsp;&nbsp;</label>
                        <input type="submit" class="form-control btn btn-success" name="submknop_<?= $recset['app_id'] ?>" value="Reserveer">
                    </div>
                </div>
                </form>
                <script type="text/javascript">
                    $(function () {
                        $('#datetimepicker_v<?=$teller?>').datetimepicker({
                            locale: 'nl',
                            daysOfWeekDisabled: [0, 6],
                            disabledDates: [ <?= $disableddays ?>]
                        });
                        $('#datetimepicker_t<?=$teller?>').datetimepicker({
                            useCurrent: false,
                            locale: 'nl',
                            daysOfWeekDisabled: [0, 6],
                            disabledDates: [ <?= $disableddays ?> ]
                        });
                        $("#datetimepicker_v<?=$teller?>").on("change.datetimepicker", function (e) {
                            $('#datetimepicker_t<?=$teller?>').datetimepicker('minDate', e.date);
                        });
                        $("#datetimepicker_t<?=$teller?>").on("change.datetimepicker", function (e) {
                            $('#datetimepicker_v<?=$teller?>').datetimepicker('maxDate', e.date);
                        });
                    });
                </script>
            </div>
        </div>
    </div>
    <?php
    $teller++;
    } ?>
</div>
</div>
</main>
<?php
include_once("inc/footer.php");
?>