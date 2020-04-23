<style>
    .time-select {
        display: inline-block;
        margin-bottom: .5rem;
    }

    .time-select__input {
        position: absolute;
        width: 1px;
        height: 1px;
        margin: -1px;
        border: 0;
        padding: 0;
        clip: rect(0 0 0 0);
        overflow: hidden;
    }

    .time-select__text {
        border-radius: 5px;
        border: 1px solid rgb(81, 158, 235);
        display: inline-block;
        margin-left: 5px;
        width: 50px;
        text-align: center;
        color: rgb(81, 158, 235);
        font-size: 12px;
        font-weight: 300;
        cursor: pointer;
    }

    .time-select__text--holiday {
        border: 1px solid rgb(81, 158, 235);
    }

    .time-select__input:checked ~ .time-select__text--holiday {
        background-color: rgb(81, 158, 235);
        color: rgb(255, 255, 255);
    }

    .time-select__text--work {
        background-color: rgb(236, 245, 255);
        border-color: rgb(236, 245, 255);
    }

    .time-select__input:checked ~ .time-select__text--work {
        background-color: #fff;
    }

</style>
<h2 class="text-center">Время работы</h2>
<div id="sucTimework" class="alert alert-info hidden">Сохранено</div>

<div class="overTimeWorkAdmin">

    <table class="table table-bordered">
        <tr>
            <td>Понедельник</td>
            <td>
                <input type="time" data-type="dayMo" data-value="start"
                       value="<?php echo $time_work['dayMo']['start'] ?>"/>
            </td>
            <td>
                <input type="time" data-type="dayMo" data-value="end" value="<?php echo $time_work['dayMo']['end'] ?>"/>
            </td>

            <td>
                <?php
                $notwork = "checked";
                if (!$time_work['dayMo']['notwork']) {
                    $notwork = "";
                }
                ?>

                <label class="time-select">
                    <input
                        <?php echo $notwork;?>
                        class="time-select__input"
                        data-type="dayMo" data-value="notwork"
                        type="checkbox"
                    />
                    <span class="time-select__text time-select__text--work">роб </span>
                    <span class="time-select__text time-select__text--holiday">вых </span>
                </label>
            </td>
        </tr>
        <tr>

            <td>Вторник</td>
            <td>
                <input data-type="dayTu" data-value="start" type="time"
                       value="<?php echo $time_work['dayTu']['start'] ?>"/>
            </td>
            <td>
                <input data-type="dayTu" data-value="end" type="time" value="<?php echo $time_work['dayTu']['end'] ?>"/>
            </td>
            <td>
                <?php
                $notwork = "checked";
                if (!$time_work['dayTu']['notwork']) {
                    $notwork = "";
                }
                ?>

                <label class="time-select">
                    <input
                        <?php echo $notwork;?>
                        class="time-select__input"
                        data-type="dayTu" data-value="notwork"
                        type="checkbox"
                    />
                    <span class="time-select__text time-select__text--work">роб </span>
                    <span class="time-select__text time-select__text--holiday">вых </span>
                </label>
            </td>

        </tr>
        <tr>

            <td>Среда</td>
            <td>
                <input data-type="dayWE" data-value="start" type="time"
                       value="<?php echo $time_work['dayWE']['start'] ?>"/>
            </td>
            <td>
                <input data-type="dayWE" data-value="end" type="time" value="<?php echo $time_work['dayWE']['end'] ?>"/>
            </td>
            <td>
                <?php
                $notwork = "checked";
                if (!$time_work['dayWE']['notwork']) {
                    $notwork = "";
                }
                ?>

                <label class="time-select">
                    <input
                        <?php echo $notwork;?>
                        class="time-select__input"
                        data-type="dayWE" data-value="notwork"
                        type="checkbox"
                    />
                    <span class="time-select__text time-select__text--work">роб </span>
                    <span class="time-select__text time-select__text--holiday">вых </span>
                </label>
            </td>

        </tr>
        <tr>

            <td>Четверг</td>
            <td>
                <input data-type="dayTH" data-value="start" type="time"
                       value="<?php echo $time_work['dayTH']['start'] ?>"/>
            </td>
            <td>
                <input data-type="dayTH" data-value="end" type="time" value="<?php echo $time_work['dayTH']['end'] ?>"/>
            </td>
            <td>
                <?php
                $notwork = "checked";
                if (!$time_work['dayTH']['notwork']) {
                    $notwork = "";
                }
                ?>

                <label class="time-select">
                    <input
                        <?php echo $notwork;?>
                        class="time-select__input"
                        data-type="dayTH" data-value="notwork"
                        type="checkbox"
                    />
                    <span class="time-select__text time-select__text--work">роб </span>
                    <span class="time-select__text time-select__text--holiday">вых </span>
                </label>
            </td>

        </tr>
        <tr>

            <td>Пятница</td>
            <td>
                <input data-type="dayFR" data-value="start" type="time"
                       value="<?php echo $time_work['dayFR']['start'] ?>"/>
            </td>
            <td>
                <input type="time" data-type="dayFR" data-value="end" type="time"
                       value="<?php echo $time_work['dayFR']['end'] ?>"/>
            </td>
            <td>
                <?php
                $notwork = "checked";
                if (!$time_work['dayFR']['notwork']) {
                    $notwork = "";
                }
                ?>

                <label class="time-select">
                    <input
                        <?php echo $notwork;?>
                        class="time-select__input"
                        data-type="dayFR" data-value="notwork"
                        type="checkbox"
                    />
                    <span class="time-select__text time-select__text--work">роб </span>
                    <span class="time-select__text time-select__text--holiday">вых </span>
                </label>
            </td>


        </tr>
        <tr>


            <td>Cуббота</td>
            <td>
                <input data-type="daySA" data-value="start" type="time"
                       value="<?php echo $time_work['daySA']['start'] ?>"/>
            </td>
            <td>
                <input data-type="daySA" data-value="end" type="time" value="<?php echo $time_work['daySA']['end'] ?>"/>
            </td>
            <td>
                <?php
                $notwork = "checked";
                if (!$time_work['daySA']['notwork']) {
                    $notwork = "";
                }
                ?>

                <label class="time-select">
                    <input
                        <?php echo $notwork;?>
                        class="time-select__input"
                        data-type="daySA" data-value="notwork"
                        type="checkbox"
                    />
                    <span class="time-select__text time-select__text--work">роб </span>
                    <span class="time-select__text time-select__text--holiday">вых </span>
                </label>
            </td>


        </tr>
        <tr>

            <td>Воскресенье</td>
            <td>
                <input data-type="daySU" data-value="start" type="time"
                       value="<?php echo $time_work['daySU']['start'] ?>"/>
            </td>
            <td>
                <input data-type="daySU" data-value="end" type="time" value="<?php echo $time_work['daySU']['end'] ?>"/>
            </td>
            <td>
                <?php
                $notwork = "checked";
                if (!$time_work['daySU']['notwork']) {
                    $notwork = "";
                }
                ?>

                <label class="time-select">
                    <input
                        <?php echo $notwork;?>
                        class="time-select__input"
                        data-type="daySU" data-value="notwork"
                        type="checkbox"
                    />
                    <span class="time-select__text time-select__text--work">роб </span>
                    <span class="time-select__text time-select__text--holiday">вых </span>
                </label>
            </td>

        </tr>
    </table>

    <div class="buttonBlock text-center">
        <button id="saveTimeWork" data-id="<?php echo $id;?>" class="btn btn-primary">Сохранить</button>
    </div>
    <hr>

</div>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    jQuery(document).ready(function ($) {
        let ar = [
            'dayMo',
            'dayTu',
            'dayWE',
            'dayTH',
            'dayFR',
            'daySA',
            'daySU'
        ];
        $('#saveTimeWork').click(function (event) {
            event.preventDefault();
            $('#saveTimeWork').prop('disabled', true)
            let id = $(this).data('id');
            let res = {};
            for (var i = 0; i < ar.length; i++) {
                var el = ar[i];
                var start = $('[data-type="' + el + '"][data-value="start"]').val();
                var end = $('[data-type="' + el + '"][data-value="end"]').val();
                var ch = false;
                if ($('[data-type="' + el + '"][data-value="notwork"]').prop("checked")) {
                    ch = true;
                }
                res[el] = {
                    start: start,
                    end: end,
                    notwork: ch
                };
            }
            axios.post('/api/saveTimeWork',{res: res, id: id} )
                .then(function (response) {
                    $('#saveTimeWork').prop('disabled', false);
                    $('#sucTimework').removeClass('hidden')
                    setTimeout(function () {
                        $('#sucTimework').addClass('hidden')
                    }, 2000)
                })
                .catch(function (error) {
                    console.log(error);
                })
        });
        //dayMo: {start: "10:00", end: "21:00", notwork: false}
    });
</script>
