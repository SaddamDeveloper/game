<template>
    <div>
        <div class="uk-container-expand wi-win-parity-bg">
            <div class="uk-padding-small">
                <div class="uk-position-relative uk-margin-remove-top">
                    <div class="uk-position-relative wi-win-parity-period">
                        <p>
                            <span class="wi-nav-icon">
                                <Icon type="md-trophy" />
                            </span>
                            <span class="wi-win-parity-period">Period</span>
                        </p>
                    </div>
                    <div class="uk-position-relative">
                        <p class="wi-recharge-blnce" style="font-size: 20px">
                            {{ gameId }}
                        </p>
                    </div>
                    <div class="uk-position-top-right">
                        <div class="uk-position-relative wi-win-parity-period">
                            <p>Count Down</p>
                        </div>
                        <div class="uk-position-relative">
                            <div class="wi-recharge-blnce">
                                <span
                                    id="timer"
                                    class="countdownfifteen"
                                    style="font-size: 20px"
                                ></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="uk-container">
                    <!-- 10 Buttons -->
                    <div uk-margin class="uk-text-center wi-win-clr-btn">
                        <button
                            class="uk-button uk-border-rounded"
                            style="background-color: #ff0000"
                            @click="
                                addModal(
                                    116,
                                    'Join Red',
                                    'background-color:#FF0000;color:#fff'
                                )
                            "
                            size="large"
                            :loading="data.loading"
                            :disabled="disabled"
                        >
                            Join Red
                        </button>
                        <button
                            class="uk-button uk-border-rounded"
                            style="background-color: #00ff1f; color: #333"
                            @click="
                                addModal(
                                    117,
                                    'Join Green',
                                    'background-color:#00FF1F;color:#333'
                                )
                            "
                            size="large"
                            :loading="data.loading"
                            :disabled="disabled"
                        >
                            Join Green
                        </button>
                        <button
                            class="uk-button uk-border-rounded"
                            style="background-color: #0027ff"
                            @click="
                                addModal(
                                    118,
                                    'Join Blue',
                                    'background-color:#0027ff;color:#fff'
                                )
                            "
                            size="large"
                            :loading="data.loading"
                            :disabled="disabled"
                        >
                            Join Blue
                        </button>
                        <button
                            class="uk-button uk-border-rounded"
                            style="background-color: #9400d3"
                            @click="
                                addModal(
                                    119,
                                    'Join Violet',
                                    'background-color:#9400D3;color:#fff'
                                )
                            "
                            size="large"
                            :loading="data.loading"
                            :disabled="disabled"
                        >
                            Join Violet
                        </button>
                        <button
                            class="uk-button uk-border-rounded"
                            style="background-color: #f8de7e; color: #333"
                            @click="
                                addModal(
                                    120,
                                    'Join Yellow',
                                    'background-color:#F8DE7E;color:#333'
                                )
                            "
                            size="large"
                            :loading="data.loading"
                            :disabled="disabled"
                        >
                            Join Yellow
                        </button>
                        <button
                            class="uk-button uk-border-rounded"
                            style="background-color: #ffc0cb; color: #333"
                            @click="
                                addModal(
                                    121,
                                    'Join Pink',
                                    'background-color:#FFC0CB;color:#333'
                                )
                            "
                            size="large"
                            :loading="data.loading"
                            :disabled="disabled"
                        >
                            Join Pink
                        </button>
                        <button
                            class="uk-button uk-border-rounded"
                            style="background-color: #964b00"
                            @click="
                                addModal(
                                    122,
                                    'Join Brown',
                                    'background-color:#964B00;color:#fff'
                                )
                            "
                            size="large"
                            :loading="data.loading"
                            :disabled="disabled"
                        >
                            Join Brown
                        </button>
                        <button
                            class="uk-button uk-border-rounded"
                            style="background-color: #808080"
                            @click="
                                addModal(
                                    123,
                                    'Join Grey',
                                    'background-color:#808080'
                                )
                            "
                            size="large"
                            :loading="data.loading"
                            :disabled="disabled"
                        >
                            Join Grey
                        </button>
                        <button
                            class="uk-button uk-border-rounded"
                            style="background-color: #00ffff; color: #333"
                            @click="
                                addModal(
                                    124,
                                    'Join Aqua',
                                    'background-color:#00FFFF;color:#333'
                                )
                            "
                            size="large"
                            :loading="data.loading"
                            :disabled="disabled"
                        >
                            Join Aqua
                        </button>
                        <button
                            class="uk-button uk-border-rounded last-btn"
                            style="background-color: #ff5722"
                            @click="
                                addModal(
                                    125,
                                    'Join Orange',
                                    'background-color:#ff5722'
                                )
                            "
                            size="large"
                            :loading="data.loading"
                            :disabled="disabled"
                        >
                            Join Orange
                        </button>
                    </div>
                    <!-- 0 Ending 10 Buttons -->
                    <div
                        uk-margin
                        class="uk-text-center wi-win-clr-btn ending-btn uk-margin"
                    >
                        <button
                            class="uk-button uk-border-rounded"
                            style="background-color: #272525"
                            :disabled="disabled"
                            @click="
                                addModal(126,'0 Ending','background-color: #333;color:#fff', 1)
                            "
                        >
                            0' Ending
                        </button>
                        <button
                            class="uk-button uk-border-rounded"
                            style="background-color: #272525"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    127,
                                    '1 Ending',
                                    'background-color: #333;color:#fff', 1
                                )
                            "
                        >
                            1' Ending
                        </button>
                        <button
                            class="uk-button uk-border-rounded"
                            style="background-color: #272525"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    128,
                                    '2 Ending',
                                    'background-color: #333;color:#fff', 1
                                )
                            "
                        >
                            2' Ending
                        </button>
                        <button
                            class="uk-button uk-border-rounded"
                            style="background-color: #272525"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    129,
                                    '3 Ending',
                                    'background-color: #333;color:#fff', 1
                                )
                            "
                        >
                            3' Ending
                        </button>
                        <button
                            class="uk-button uk-border-rounded"
                            style="background-color: #272525"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    130,
                                    '4 Ending',
                                    'background-color: #333;color:#fff', 1
                                )
                            "
                        >
                            4' Ending
                        </button>
                        <button
                            class="uk-button uk-border-rounded"
                            style="background-color: #272525"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    131,
                                    '5 Ending',
                                    'background-color: #333;color:#fff', 1
                                )
                            "
                        >
                            5' Ending
                        </button>
                        <button
                            class="uk-button uk-border-rounded"
                            style="background-color: #272525"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    132,
                                    '6 Ending',
                                    'background-color: #333;color:#fff', 1
                                )
                            "
                        >
                            6' Ending
                        </button>
                        <button
                            class="uk-button uk-border-rounded"
                            style="background-color: #272525"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    133,
                                    '7 Ending',
                                    'background-color: #333;color:#fff', 1
                                )
                            "
                        >
                            7' Ending
                        </button>
                        <button
                            class="uk-button uk-border-rounded"
                            style="background-color: #272525"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    134,
                                    '8 Ending',
                                    'background-color: #333;color:#fff', 1
                                )
                            "
                        >
                            8' Ending
                        </button>
                        <button
                            class="uk-button uk-border-rounded"
                            style="background-color: #272525"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    135,
                                    '9 Ending',
                                    'background-color: #333;color:#fff', 1
                                )
                            "
                        >
                            9' Ending
                        </button>
                    </div>
                </div>
            </div>
            <div class="uk-margin">
                <div class="uk-container list uk-text-center">
                    <!-- 00-09 -->
                    <div class="number-block">
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :zeroending="(zeroending = true)"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    16,
                                    'Number 00',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            00
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    17,
                                    'Number 01',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            01
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    18,
                                    'Number 02',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            02
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    19,
                                    'Number 03',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            03
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    20,
                                    'Number 04',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            04
                        </button>
                    </div>
                    <div class="uk-margin number-block">
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    21,
                                    'Number 05',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            05
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    22,
                                    'Number 06',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            06
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    23,
                                    'Number 07',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            07
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    24,
                                    'Number 08',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            08
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    25,
                                    'Number 09',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            09
                        </button>
                    </div>

                    <!-- 11-19 -->
                    <div class="number-block">
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    26,
                                    'Number 10',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            10
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    27,
                                    'Number 11',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            11
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    28,
                                    'Number 12',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            12
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    29,
                                    'Number 13',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            13
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    30,
                                    'Number 14',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            14
                        </button>
                    </div>
                    <div class="uk-margin number-block">
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    31,
                                    'Number 15',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            15
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    32,
                                    'Number 16',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            16
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    33,
                                    'Number 17',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            17
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    34,
                                    'Number 18',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            18
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    35,
                                    'Number 19',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            19
                        </button>
                    </div>

                    <!-- 21-29 -->
                    <div class="number-block">
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    36,
                                    'Number 20',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            20
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    37,
                                    'Number 21',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            21
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    38,
                                    'Number 22',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            22
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    39,
                                    'Number 23',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            23
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    40,
                                    'Number 24',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            24
                        </button>
                    </div>
                    <div class="uk-margin number-block">
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    41,
                                    'Number 25',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            25
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    42,
                                    'Number 26',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            26
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    43,
                                    'Number 27',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            27
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    44,
                                    'Number 28',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            28
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    45,
                                    'Number 29',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            29
                        </button>
                    </div>

                    <!-- 31-39 -->
                    <div class="number-block">
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    46,
                                    'Number 30',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            30
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    47,
                                    'Number 31',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            31
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    48,
                                    'Number 32',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            32
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    49,
                                    'Number 33',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            33
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    50,
                                    'Number 34',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            34
                        </button>
                    </div>
                    <div class="uk-margin number-block">
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    51,
                                    'Number 35',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            35
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    52,
                                    'Number 36',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            36
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    53,
                                    'Number 37',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            37
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    54,
                                    'Number 38',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            38
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    55,
                                    'Number 39',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            39
                        </button>
                    </div>

                    <!-- 41-49 -->
                    <div class="number-block">
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    56,
                                    'Number 40',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            40
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    57,
                                    'Number 41',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            41
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    58,
                                    'Number 42',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            42
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    59,
                                    'Number 43',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            43
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    60,
                                    'Number 44',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            44
                        </button>
                    </div>
                    <div class="uk-margin number-block">
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    61,
                                    'Number 45',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            45
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    62,
                                    'Number 46',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            46
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    63,
                                    'Number 47',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            47
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    64,
                                    'Number 48',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            48
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    65,
                                    'Number 49',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            49
                        </button>
                    </div>

                    <!-- 51-59 -->
                    <div class="number-block">
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    66,
                                    'Number 50',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            50
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    67,
                                    'Number 51',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            51
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    68,
                                    'Number 52',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            52
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    69,
                                    'Number 53',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            53
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    70,
                                    'Number 54',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            54
                        </button>
                    </div>
                    <div class="uk-margin number-block">
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    71,
                                    'Number 55',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            55
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    72,
                                    'Number 56',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            56
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    73,
                                    'Number 57',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            57
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    74,
                                    'Number 58',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            58
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    75,
                                    'Number 59',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            59
                        </button>
                    </div>

                    <!-- 61-69 -->
                    <div class="number-block">
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    76,
                                    'Number 60',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            60
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    77,
                                    'Number 61',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            61
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    78,
                                    'Number 62',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            62
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    79,
                                    'Number 63',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            63
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    80,
                                    'Number 64',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            64
                        </button>
                    </div>
                    <div class="uk-margin number-block">
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    81,
                                    'Number 65',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            65
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    82,
                                    'Number 66',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            66
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    83,
                                    'Number 67',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            67
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    84,
                                    'Number 68',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            68
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    85,
                                    'Number 69',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            69
                        </button>
                    </div>

                    <!-- 71-79 -->
                    <div class="number-block">
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    86,
                                    'Number 70',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            70
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    87,
                                    'Number 71',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            71
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    88,
                                    'Number 72',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            72
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    89,
                                    'Number 73',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            73
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    90,
                                    'Number 74',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            74
                        </button>
                    </div>
                    <div class="uk-margin number-block">
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    91,
                                    'Number 75',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            75
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    92,
                                    'Number 76',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            76
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    93,
                                    'Number 77',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            77
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    94,
                                    'Number 78',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            78
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    95,
                                    'Number 79',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            79
                        </button>
                    </div>

                    <!-- 81-89 -->
                    <div class="number-block">
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    96,
                                    'Number 80',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            80
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    97,
                                    'Number 81',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            81
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    98,
                                    'Number 82',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            82
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    99,
                                    'Number 83',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            83
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    100,
                                    'Number 84',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            84
                        </button>
                    </div>
                    <div class="uk-margin number-block">
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    101,
                                    'Number 85',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            85
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    102,
                                    'Number 86',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            86
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    103,
                                    'Number 87',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            87
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    104,
                                    'Number 88',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            88
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    105,
                                    'Number 89',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            89
                        </button>
                    </div>

                    <!-- 91-99 -->
                    <div class="number-block">
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    106,
                                    'Number 90',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            90
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    107,
                                    'Number 91',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            91
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    108,
                                    'Number 92',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            92
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    109,
                                    'Number 93',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            93
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    110,
                                    'Number 94',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            94
                        </button>
                    </div>
                    <div class="uk-margin number-block">
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    111,
                                    'Number 95',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            95
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    112,
                                    'Number 96',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            96
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    113,
                                    'Number 97',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            97
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    114,
                                    'Number 98',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            98
                        </button>
                        <button
                            class="wi-badge wi-win-number-clr no-outline"
                            :disabled="disabled"
                            @click="
                                addModal(
                                    115,
                                    'Number 99',
                                    'background-color: #009788;color:#fff'
                                )
                            "
                        >
                            99
                        </button>
                    </div>
                    <button id="loadmore">Load More</button>
                </div>
            </div>
        </div>
        <div class="uk-margin-large-bottom">
            <div class="uk-container">
                <div class="uk-margin-auto uk-margin-small-bottom">
                    <div class="wi-Parity-underline">
                        <p class="wi-nav-icon uk-text-center">
                            <Icon type="md-trophy" />
                        </p>
                        <p class="wi-Parity-Record uk-text-center">
                            15 Minutes Game Record
                        </p>
                    </div>
                    <table
                        class="uk-table wi-table uk-table-middle uk-table-divider"
                    >
                        <thead>
                            <tr>
                                <th class="uk-table-expand" scope="col">
                                    Period
                                </th>
                                <th scope="col">Number</th>
                                <th scope="col">Number Ending</th>
                                <th scope="col">Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(result, i) in tenResults"
                                :key="i"
                                v-if="tenResults.length"
                            >
                                <td data-label="Period">
                                    {{ result.game_play_id }}
                                </td>
                                <td
                                    class="wi-record-no-red"
                                    data-label="Number"
                                >
                                    {{ result.number_value }}
                                </td>
                                <td
                                    class="wi-record-no-red"
                                    data-label="Number"
                                >
                                    {{ result.ending_number_value }}
                                </td>
                                <td
                                    class="wi-record-no-red"
                                    data-label="Result"
                                >
                                    <span
                                        class="wi-badge-result"
                                        :style="{
                                            'background-color':
                                                result.color_value,
                                        }"
                                    ></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="uk-position-relative">
                        <Pagination
                            :pagination="paginationData2"
                            @clickEmit="fetchTenResults"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="wi-Parity-border"></div>
        <div class="uk-padding-remove-top">
            <div class="uk-container">
                <div class="uk-margin-auto">
                    <div class="wi-myParity-underline">
                        <p class="wi-nav-icon uk-text-center">
                            <Icon type="md-trophy" />
                        </p>
                        <p class="wi-Parity-Record uk-text-center">
                            My Parity Record
                        </p>
                    </div>
                    <div class="uk-margin">
                        <table
                            class="uk-table wi-table uk-table-middle uk-table-divider"
                        >
                            <thead>
                                <tr>
                                    <th class="uk-table-expand" scope="col">
                                        Period
                                    </th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(parity, i) in myparity"
                                    :key="i"
                                    v-if="myparity.length"
                                >
                                    <td>{{ parity.game_play_id }}</td>
                                    <td>{{ parity.amount }}</td>
                                    <td>
                                        <span
                                            class="uk-label uk-label-warning"
                                            v-if="
                                                parity.is_win == '1' &&
                                                parity.status == '1'
                                            "
                                            >Pending</span
                                        >
                                        <span
                                            class="uk-label uk-label-danger"
                                            v-if="
                                                parity.is_win == '1' &&
                                                parity.status == '2'
                                            "
                                            >Fail</span
                                        >
                                        <span
                                            class="uk-label uk-label-success"
                                            v-if="
                                                parity.is_win == '2' &&
                                                parity.status == '2'
                                            "
                                            >Success</span
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr />
            <div class="uk-position-relative uk-padding">
                <Pagination
                    :pagination="paginationData"
                    @clickEmit="myParityRecord"
                />
            </div>
        </div>
        <div class="wi-MyParity-border"></div>

        <!-- color model -->
        <div id="color-model" class="uk-flex-top" uk-modal>
            <div class="uk-modal-dialog">
                <div id="header"></div>
                <div class="uk-modal-body">
                    <div class="">
                        <p class="wi-win-popup-text">Contract Money</p>
                        <div class="uk-container-expand">
                            <div>
                                <div
                                    class="wi-model-contract-money uk-button-group uk-margin-small uk-margin-small-top"
                                >
                                    <RadioGroup
                                        v-model="data.battingData.amount"
                                        type="button"
                                    >
                                        <Radio
                                            class="uk-button uk-button-secondary uk-active"
                                            label="10.00"
                                        ></Radio>
                                        <Radio label="100.00"></Radio>
                                        <Radio label="1000.00"></Radio>
                                    </RadioGroup>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-margin-small-top">
                        <p class="wi-win-popup-text">Contract Count</p>
                        <div class="uk-container-expand">
                            <div class="uk-margin-small uk-margin-small-top">
                                <button type="button" id="sub" :disabled="data.battingData.qty == 1 ? dis == true : dis == false" @click="data.battingData.qty--" class="sub win-model-plus-minus">
                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                </button>
                                <input type="text" id="1" min="1" v-model="data.battingData.qty" class="wi-win-popup-qntity-input"/>
                                <button type="button" id="add" @click="data.battingData.qty++" class="add win-model-plus-minus">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="uk-margin-medium-top">
                        <span class="wi-win-popup-text">Total contract money is
                            {{ status == 0 ? (data.battingData.contractMoney = (data.battingData.amount * data.battingData.qty).toFixed(2)) : data.battingData.contractMoney = (newAmount * data.battingData.qty).toFixed(2)}}</span>
                        <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                            <label></label
                            ><input
                                class="from-control"
                                type="checkbox"
                                v-model="check"
                                required
                                style="margin: 3px; width: 20px; height: 15px"
                            />
                            <span style="color: gray">I agree </span
                            ><a href="#read-rule" uk-toggle>Presale Rule </a>
                        </div>
                    </div>
                </div>
                <div class="uk-text-right wi-win-popup-btn">
                    <button
                        class="uk-button uk-button-default uk-modal-close wi-model-cancle-btn"
                        type="button"
                    >
                        Cancel
                    </button>
                    <button
                        class="uk-button uk-button-primary wi-model-confirm-btn"
                        type="button"
                        @click="addBatting"
                        :disabled="data.isAdding"
                        :loading="data.isAdding"
                    >
                        {{ data.isAdding ? "Confirming..." : "Confirm" }}
                    </button>
                </div>
            </div>
        </div>

        <!-- read rule model-->
        <div
            id="read-rule"
            class="uk-flex-top uk-margin-medium-bottom"
            uk-modal
        >
            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                <button
                    class="uk-modal-close-default"
                    type="button"
                    uk-close
                ></button>
                <strong>Rules of guess:</strong>
                <p>
                    3 minutes 1 issue, 2 minutes and 30 seconds to order, 30
                    seconds to show the lottery result. It opens all day. The
                    total number of trade is 480 issues.
                </p>
                <p>
                    If you spend 100 rupees to trade, your contract amount is
                    100 rupees:
                </p>
                <p>
                    1.JOIN GREEN: if the result shows 1,3,7,9, you will get
                    (100*2) 200 rupees;
                </p>
                <p>If the result shows 5, you will get (100*1.5) 150 rupees.</p>
                <ul class="uk-list">
                    <li>
                        2. JOIN RED: if the result shows 2,4,6,8, you will get
                        (100*2) 200 rupees; If the result shows 0, you will get
                        (100*1.5) 150 rupees.
                    </li>
                    <li>
                        3. JOIN VIOLET: if the result shows 0 or 5, you will get
                        (100*4.5) 450 rupees.
                    </li>
                    <li>
                        4. SELECT NUMBER: if the result is the same as the
                        number you selected, you will get (100*9) 900 rupees.
                    </li>
                </ul>
            </div>
        </div>
        <!-- Result Modal -->
        <Modal v-model="resultModal" title="Result">
            <div class="modal-top" v-if="results.winningAmt != 0">
                <img
                    class="modal-icon u-imgResponsive"
                    src="img/trophy.png"
                    alt="Trophy"
                />
                <div class="modal-header">
                    Congratulations
                    <p class="modal-subheader">
                        You have Win {{ results.winningAmt }} rupees
                    </p>
                </div>
            </div>
            <div
                data-v-291c8e94=""
                class="uk-position-relative uk-margin-remove-top"
            >
                <p data-v-291c8e94="" uk-margin="">
                    <span
                        data-v-291c8e94=""
                        class="wi-model-result wi-model-result-number"
                        >{{ results.number }}</span
                    >
                </p>
                <p data-v-291c8e94="" uk-margin="">
                    <span
                        data-v-291c8e94=""
                        class="wi-model-result wi-model-result-number"
                        >{{ results.ending }}</span
                    >
                </p>
                <p data-v-291c8e94="" uk-margin="">
                     <span>
                        <span
                            class="wi-badge-result"
                            :style="{
                                'background-color':
                                    results.colors,
                            }"
                        ></span>
                    </span>
                </p>
            </div>
            <div slot="footer">
                <Button type="default" @click="resultModal = false"
                    >Close</Button
                >
            </div>
        </Modal>
        <!-- Game Over Modal -->
        <Modal v-model="gameOver">
            <h1 class="lost">GAME OVER</h1>
            <div slot="footer"></div>
        </Modal>
    </div>
</template>
<script>
import store from "../../store";
import { mapGetters, mapMutations, mapActions } from "vuex";
import Pagination from "./Pagination";
import TransactionVue from "./Transaction.vue";
export default {
    components: {
        Pagination,
    },
    data() {
        return {
            status: 0,
            myparity: [],
            dis: true,
            gameId: "",
            disabled: false,
            gameOver: false,
            games: [],
            tenResults: [],
            check: false,
            results: {
                gameId: "",
                colors: "",
                number: "",
                ending:"",
                winningAmt: "",
                gameResult: [],
            },
            resultModal: false,
            readRuleModal: false,
            data: {
                walletBal: "",
                title: "",
                isAdding: false,
                modal: false,
                balance: 0,
                minutes: "",
                seconds: "",
                timer: "",
                battingData: {
                    type: "",
                    amount: 10,
                    zeroendingAmt: 100,
                    qty: 1,
                    contractMoney: 0,
                },
                userData: {
                    id: "",
                    walletBal: "",
                    mobile: "",
                    memberID: "",
                },
                time: new Date(),
                countDown: "",
                loading: true, //when goes to server it should true
            },
            paginate: {
                first_page_url: "",
                last_page_url: "",
                next_page_url: "",
                prev_page_url: "",
                current_page: "",
                last_page: "",
            },
            paginationData: {},
            paginationData2: {},
        };
    },
    computed: {
        newAmount: function () {
            return (this.data.battingData.amount * 10).toFixed(2)
        }
    },
    methods: {
        async fetchUser() {
            store.dispatch("fetchUser");
        },
        pagination(res) {
            this.paginate.first_page_url = res.first_page_url;
            this.paginate.last_page_url = res.last_page_url;
            this.paginate.next_page_url = res.next_page_url;
            this.paginate.prev_page_url = res.prev_page_url;
            this.paginate.current_page = res.current_page;
            this.paginate.last_page = res.last_page;
            this.makePagination(res.meta, res.links);
        },
        makePagination(meta, links) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev,
                per_page: meta.per_page,
            };
            this.paginationData = pagination;
        },
        pagination2(res) {
            this.paginate.first_page_url = res.first_page_url;
            this.paginate.last_page_url = res.last_page_url;
            this.paginate.next_page_url = res.next_page_url;
            this.paginate.prev_page_url = res.prev_page_url;
            this.paginate.current_page = res.current_page;
            this.paginate.last_page = res.last_page;
            this.makePagination2(res.meta, res.links);
        },
        makePagination2(meta, links) {
            let pagination2 = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev,
                per_page: meta.per_page,
            };
            this.paginationData2 = pagination2;
        },
        async addBatting() {
            if (this.check == false)
                return this.e("check terms and condtions first");
            if (this.data.battingData.contractMoney == "")
                return this.e("Amount is required!");
            if (
                store.state.users.wallet.amount <= 10 ||
                store.state.users.wallet.amount <
                    this.data.battingData.contractMoney
            )
                return this.e("Insufficient Balance!");
            if (
                store.state.users.wallet.amount -
                    this.data.battingData.contractMoney <
                10
            )
                return this.e("Maintain minimum 10 rupees balance");
            this.data.isAdding = true;
            const userData = JSON.parse(localStorage.user);
            const token = userData.token;
            const config = {
                headers: { Authorization: `Bearer ${token}` },
            };
            return axios
                .post("api/game/user/play", this.data.battingData, config)
                .then(({ data }) => {
                    if (data.status == true) {
                        this.fetchUser();
                        if (data.data.status == "LOW_BAL") {
                            this.e(data.data.msg);
                        }
                        if (data.data.status == "MAINTAIN_BAL") {
                            this.e(data.data.msg);
                        }
                        UIkit.modal("#color-model").hide();
                    } else {
                        if (data.status == 422) {
                            this.e(data.data.errors.qty[0]);
                        } else {
                            this.swr();
                        }
                    }
                    this.data.isAdding = false;
                });
        },
        async addModal(props, title, color, status=false) {
            if (status == 1) {
                this.status = 1;
                UIkit.modal("#color-model").show();
                $("#header")
                    .html(`<div class="win-all-model-header" style="${color}">
                  <h2 class="uk-modal-title" style="color:inherit">${title}</h2>
               </div>`);
                this.data.title = title;
                this.data.battingData.type = props;
            } else {
                this.data.battingData.amount = 10;
                UIkit.modal("#color-model").show();
                $("#header")
                    .html(`<div class="win-all-model-header" style="${color}">
               <h2 class="uk-modal-title" style="color:inherit">${title}</h2>
            </div>`);
                this.data.title = title;
                this.data.battingData.type = props;
            }
        },
        async gameResult() {
            const userData = JSON.parse(localStorage.user);
            const userId = userData.user.id;
            const res = await this.callApi(
                "get",
                "api/game/fifteen/result/" + this.gameId+"/"+userId
            );
            console.log(res);
            if (res.status == 200) {
                this.results.gameId = res.data.data.game_id;
                this.results.colors = res.data.data.result.color_value;
                this.results.number = res.data.data.result.number_value;
                this.results.ending = res.data.data.result.ending_number_value;
                this.results.winningAmt = res.data.data.winning_amount;
                // this.results.gameResult = res.data.data.game_result;
                this.resultModal = true;
                var fiveSecond = setTimeout(() => {
                    this.resultModal = false;
                    clearTimeout(fiveSecond);
                }, 5000);
            } else {
                this.swr();
            }
        },
        async gameCall() {
            const response = await this.callApi("get", "api/game/play/fifteen");
            if (response.status == 200) {
                this.gameId = response.data.data.id;
                this.games = response.data;
                console.log(response.data.game_status);
                if (response.data.game_status === false) {
                    // window.location.reload();
                    this.gameOver = true;
                    this.disabled = true;
                    this.data.loading = true;
                } else {
                    this.data.loading = false;
                    var timer = response.data.data.timer;
                }
                var gameTimer = setInterval(() => {
                    timer = timer - 1;
                    let minutes = Math.floor(timer / 60);
                    let seconds = Math.floor(timer - minutes * 60);
                    $(".countdownfifteen").text(
                        minutes.toString().padStart(2, "0") +
                            ":" +
                            seconds.toString().padStart(2, "0")
                    );
                    if (minutes === 0 && seconds <= 30) {
                        UIkit.modal("#color-model").hide();
                        this.data.modal = false;
                        this.disabled = true;
                        this.data.loading = true;
                    }
                    if (minutes === 0 && seconds === 0) {
                        this.gameResult();
                        clearInterval(gameTimer);
                        this.gameCall();
                    }
                }, 1000);
                this.disabled = false;
                this.fetchTenResults();
                this.myParityRecord();
            }
        },
        async fetchTenResults(page_url) {
            page_url = page_url || "api/game/full/fifteen/result";
            const response = await this.callApi("get", page_url);
            if (response.status == 200) {
                this.tenResults = response.data.data;
                this.pagination2(response.data);
            }
        },
        async user() {
            const res = await this.callApi("get", "api/user/details");
            if (res.status == 200) {
                store.commit("setUsers");
            }
        },
        async myParityRecord(page_url) {
            page_url = page_url || "api/user/my/record/";
            const userData = JSON.parse(localStorage.user);
            const token = userData.token;
            const config = {
                headers: { Authorization: `Bearer ${token}` },
            };
            return axios.get(page_url + 2, config).then(({ data }) => {
                if (data.status == true) {
                    this.myparity = data.data;
                    this.pagination = data.data;
                }
            });
        },
        realoadPage() {
            window.location.reload();
        },
    },
    async created() {
        const res = await this.callApi("get", "api/game/play/fifteen");
        if (res.status == 200) {
            this.gameId = res.data.data.id;
            this.games = res.data;
            if (res.data.game_status === false) {
                // window.location.reload();
                this.gameOver = false; //it will be true when goes live
                this.disabled = false; //it will be true when goes live
                this.data.loading = false; //it will be true when goes live
            } else {
                this.data.loading = false;
                this.disabled = false;
                var timer = res.data.data.timer;
            }
            var gameTimer = setInterval(() => {
                timer = timer - 1;
                let minutes = Math.floor(timer / 60);
                let seconds = Math.floor(timer - minutes * 60);
                $(".countdownfifteen").text(
                    minutes.toString().padStart(2, "0") +
                        ":" +
                        seconds.toString().padStart(2, "0")
                );
                if (minutes === 0 && seconds <= 30) {
                    UIkit.modal("#color-model").hide();
                    this.disabled = true;
                    this.data.loading = true;
                    this.data.modal = false;
                }
                if (minutes === 0 && seconds === 0) {
                    this.gameResult();
                    clearInterval(gameTimer);
                    this.gameCall();
                }
            }, 1000);
            this.fetchTenResults();
            this.myParityRecord();
        } else {
            this.swr();
        }
    },
};
</script>

<style scoped>
.demo-spin-icon-load {
    animation: ani-demo-spin 1s linear infinite;
}
.lost {
    text-align: center;
    overflow: hidden;
    letter-spacing: 2px;
    color: black;
    margin: 20px auto;
    width: 100%;
    font-size: 80px;
    font-family: "Cascadia Code";
    animation: bloody 4s ease infinite alternate;
    -webkit-animation: bloody 4s ease infinite alternate;
    -moz-animation: bloody 4s ease infinite alternate;
    -o-animation: bloody 4s ease infinite alternate;
    margin-bottom: 0;
    padding-bottom: 0;
    margin: auto;
}
.no-outline {
    outline: none;
    border: none;
}
button[disabled="disabled"] {
    opacity: 0.3;
}
.wi-badge-result-violet {
    background-color: #9c28b1;
}
.wi-win-parity-bg {
    height: auto !important;
}
.number-block {
    display: none;
}
#loadmore {
    margin: 30px auto 10px;
    display: table;
    border: none;
    padding: 5px 15px;
    font-size: 18px;
    line-height: 18px;
    cursor: pointer;
    color: #fff;
    border-radius: 16px;
    background-color: #262729;
    outline: none;
}
.list .number-block:nth-child(1),
.list .number-block:nth-child(2),
.list .number-block:nth-child(3),
.list .number-block:nth-child(4) {
    display: block;
}
@media screen and (max-width: 600px) {
    .wi-win-clr-btn button.uk-button.last-btn {
        width: 104px;
    }
}
</style>