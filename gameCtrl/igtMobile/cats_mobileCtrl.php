<?
require_once('IGTMobileCtrl.php');

class cats_mobileCtrl extends IGTMobileCtrl {

    protected function startPaytable($request) {
        $json = '{
    "ReturnStatus": {
        "Code": "1000000",
        "Message": "",
        "Debug": ""
    },
    "Paytable": {
        "PaytableStatistics": {
            "@description": "Cats 30L 3x3x3x3x3",
            "@maxRTP": "94.93",
            "@minRTP": "93.04",
            "@name": "Cats",
            "@type": "Slot"
        },
        "PrizeInfo": [{
            "@name": "PrizeInfoLines",
            "@strategy": "PayExpandSymbolLeft",
            "Prize": [{
                "@name": "w01",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "528095",
                    "@value": "10000"
                }, {
                    "@count": "4",
                    "@pph": "203114",
                    "@value": "1000"
                }, {
                    "@count": "3",
                    "@pph": "11788",
                    "@value": "300"
                }],
                "Symbol": {
                    "@id": "w01",
                    "@required": "true"
                }
            }, {
                "@name": "s01",
                "PrizePay": [{
                    "@count": "10",
                    "@pph": "11237",
                    "@value": "2500"
                }, {
                    "@count": "9",
                    "@pph": "3225",
                    "@value": "1000"
                }, {
                    "@count": "8",
                    "@pph": "1837",
                    "@value": "500"
                }, {
                    "@count": "7",
                    "@pph": "1301",
                    "@value": "300"
                }, {
                    "@count": "6",
                    "@pph": "367",
                    "@value": "200"
                }, {
                    "@count": "5",
                    "@pph": "160",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "47",
                    "@value": "30"
                }, {
                    "@count": "3",
                    "@pph": "21",
                    "@value": "10"
                }],
                "Symbol": [{
                    "@id": "w02",
                    "@required": "false"
                }, {
                    "@id": "s01",
                    "@required": "false"
                }]
            }, {
                "@name": "s02",
                "PrizePay": [{
                    "@count": "10",
                    "@pph": "7459",
                    "@value": "1000"
                }, {
                    "@count": "9",
                    "@pph": "2987",
                    "@value": "800"
                }, {
                    "@count": "8",
                    "@pph": "1781",
                    "@value": "500"
                }, {
                    "@count": "7",
                    "@pph": "1369",
                    "@value": "300"
                }, {
                    "@count": "6",
                    "@pph": "275",
                    "@value": "200"
                }, {
                    "@count": "5",
                    "@pph": "167",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "37",
                    "@value": "30"
                }, {
                    "@count": "3",
                    "@pph": "21",
                    "@value": "10"
                }],
                "Symbol": [{
                    "@id": "w02",
                    "@required": "false"
                }, {
                    "@id": "s02",
                    "@required": "false"
                }]
            }, {
                "@name": "s03",
                "PrizePay": [{
                    "@count": "10",
                    "@pph": "8546",
                    "@value": "1000"
                }, {
                    "@count": "9",
                    "@pph": "3390",
                    "@value": "800"
                }, {
                    "@count": "8",
                    "@pph": "2017",
                    "@value": "500"
                }, {
                    "@count": "7",
                    "@pph": "1547",
                    "@value": "300"
                }, {
                    "@count": "6",
                    "@pph": "315",
                    "@value": "200"
                }, {
                    "@count": "5",
                    "@pph": "188",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "37",
                    "@value": "25"
                }, {
                    "@count": "3",
                    "@pph": "21",
                    "@value": "10"
                }],
                "Symbol": [{
                    "@id": "w02",
                    "@required": "false"
                }, {
                    "@id": "s03",
                    "@required": "false"
                }]
            }, {
                "@name": "s04",
                "PrizePay": [{
                    "@count": "10",
                    "@pph": "5661",
                    "@value": "1000"
                }, {
                    "@count": "9",
                    "@pph": "2611",
                    "@value": "800"
                }, {
                    "@count": "8",
                    "@pph": "1568",
                    "@value": "500"
                }, {
                    "@count": "7",
                    "@pph": "1259",
                    "@value": "300"
                }, {
                    "@count": "6",
                    "@pph": "216",
                    "@value": "200"
                }, {
                    "@count": "5",
                    "@pph": "155",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "25",
                    "@value": "25"
                }, {
                    "@count": "3",
                    "@pph": "17",
                    "@value": "10"
                }],
                "Symbol": [{
                    "@id": "w02",
                    "@required": "false"
                }, {
                    "@id": "s04",
                    "@required": "false"
                }]
            }, {
                "@name": "s05",
                "PrizePay": [{
                    "@count": "10",
                    "@pph": "5140",
                    "@value": "1000"
                }, {
                    "@count": "9",
                    "@pph": "3040",
                    "@value": "800"
                }, {
                    "@count": "8",
                    "@pph": "1689",
                    "@value": "500"
                }, {
                    "@count": "7",
                    "@pph": "1547",
                    "@value": "200"
                }, {
                    "@count": "6",
                    "@pph": "223",
                    "@value": "150"
                }, {
                    "@count": "5",
                    "@pph": "201",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "25",
                    "@value": "25"
                }, {
                    "@count": "3",
                    "@pph": "23",
                    "@value": "10"
                }],
                "Symbol": [{
                    "@id": "w02",
                    "@required": "false"
                }, {
                    "@id": "s05",
                    "@required": "false"
                }]
            }, {
                "@name": "s06",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "203",
                    "@value": "200"
                }, {
                    "@count": "4",
                    "@pph": "94",
                    "@value": "20"
                }, {
                    "@count": "3",
                    "@pph": "09",
                    "@value": "8"
                }],
                "Symbol": [{
                    "@id": "w01",
                    "@required": "false"
                }, {
                    "@id": "s06",
                    "@required": "false"
                }]
            }, {
                "@name": "s07",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "224",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "104",
                    "@value": "15"
                }, {
                    "@count": "3",
                    "@pph": "08",
                    "@value": "5"
                }],
                "Symbol": [{
                    "@id": "w01",
                    "@required": "false"
                }, {
                    "@id": "s07",
                    "@required": "false"
                }]
            }, {
                "@name": "s08",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "203",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "94",
                    "@value": "15"
                }, {
                    "@count": "3",
                    "@pph": "09",
                    "@value": "5"
                }],
                "Symbol": [{
                    "@id": "w01",
                    "@required": "false"
                }, {
                    "@id": "s08",
                    "@required": "false"
                }]
            }, {
                "@name": "s09",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "224",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "104",
                    "@value": "15"
                }, {
                    "@count": "3",
                    "@pph": "08",
                    "@value": "5"
                }],
                "Symbol": [{
                    "@id": "w01",
                    "@required": "false"
                }, {
                    "@id": "s09",
                    "@required": "false"
                }]
            }]
        }, {
            "@name": "BonusPrizeInfoLines",
            "@strategy": "PayExpandSymbolLeft",
            "Prize": [{
                "@name": "w01",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "279572",
                    "@value": "10000"
                }, {
                    "@count": "4",
                    "@pph": "86022",
                    "@value": "1000"
                }, {
                    "@count": "3",
                    "@pph": "4236",
                    "@value": "300"
                }],
                "Symbol": {
                    "@id": "w01",
                    "@required": "true"
                }
            }, {
                "@name": "s10",
                "PrizePay": [{
                    "@count": "10",
                    "@pph": "1667",
                    "@value": "2500"
                }, {
                    "@count": "9",
                    "@pph": "1037",
                    "@value": "1000"
                }, {
                    "@count": "8",
                    "@pph": "505",
                    "@value": "500"
                }, {
                    "@count": "7",
                    "@pph": "469",
                    "@value": "300"
                }, {
                    "@count": "6",
                    "@pph": "70",
                    "@value": "200"
                }, {
                    "@count": "5",
                    "@pph": "72",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "04",
                    "@value": "30"
                }, {
                    "@count": "3",
                    "@pph": "10",
                    "@value": "10"
                }],
                "Symbol": [{
                    "@id": "w02",
                    "@required": "false"
                }, {
                    "@id": "s10",
                    "@required": "false"
                }]
            }, {
                "@name": "s11",
                "PrizePay": [{
                    "@count": "10",
                    "@pph": "1670",
                    "@value": "1000"
                }, {
                    "@count": "9",
                    "@pph": "1037",
                    "@value": "800"
                }, {
                    "@count": "8",
                    "@pph": "505",
                    "@value": "500"
                }, {
                    "@count": "7",
                    "@pph": "469",
                    "@value": "300"
                }, {
                    "@count": "6",
                    "@pph": "70",
                    "@value": "200"
                }, {
                    "@count": "5",
                    "@pph": "72",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "04",
                    "@value": "30"
                }, {
                    "@count": "3",
                    "@pph": "10",
                    "@value": "10"
                }],
                "Symbol": [{
                    "@id": "w02",
                    "@required": "false"
                }, {
                    "@id": "s11",
                    "@required": "false"
                }]
            }, {
                "@name": "s12",
                "PrizePay": [{
                    "@count": "10",
                    "@pph": "1670",
                    "@value": "1000"
                }, {
                    "@count": "9",
                    "@pph": "1037",
                    "@value": "800"
                }, {
                    "@count": "8",
                    "@pph": "505",
                    "@value": "500"
                }, {
                    "@count": "7",
                    "@pph": "469",
                    "@value": "300"
                }, {
                    "@count": "6",
                    "@pph": "70",
                    "@value": "200"
                }, {
                    "@count": "5",
                    "@pph": "72",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "04",
                    "@value": "25"
                }, {
                    "@count": "3",
                    "@pph": "10",
                    "@value": "10"
                }],
                "Symbol": [{
                    "@id": "w02",
                    "@required": "false"
                }, {
                    "@id": "s12",
                    "@required": "false"
                }]
            }, {
                "@name": "s13",
                "PrizePay": [{
                    "@count": "10",
                    "@pph": "1670",
                    "@value": "1000"
                }, {
                    "@count": "9",
                    "@pph": "1037",
                    "@value": "800"
                }, {
                    "@count": "8",
                    "@pph": "505",
                    "@value": "500"
                }, {
                    "@count": "7",
                    "@pph": "469",
                    "@value": "300"
                }, {
                    "@count": "6",
                    "@pph": "70",
                    "@value": "200"
                }, {
                    "@count": "5",
                    "@pph": "72",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "04",
                    "@value": "25"
                }, {
                    "@count": "3",
                    "@pph": "10",
                    "@value": "10"
                }],
                "Symbol": [{
                    "@id": "w02",
                    "@required": "false"
                }, {
                    "@id": "s13",
                    "@required": "false"
                }]
            }, {
                "@name": "s14",
                "PrizePay": [{
                    "@count": "10",
                    "@pph": "1670",
                    "@value": "1000"
                }, {
                    "@count": "9",
                    "@pph": "1037",
                    "@value": "800"
                }, {
                    "@count": "8",
                    "@pph": "505",
                    "@value": "500"
                }, {
                    "@count": "7",
                    "@pph": "469",
                    "@value": "200"
                }, {
                    "@count": "6",
                    "@pph": "70",
                    "@value": "150"
                }, {
                    "@count": "5",
                    "@pph": "72",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "04",
                    "@value": "25"
                }, {
                    "@count": "3",
                    "@pph": "10",
                    "@value": "10"
                }],
                "Symbol": [{
                    "@id": "w02",
                    "@required": "false"
                }, {
                    "@id": "s14",
                    "@required": "false"
                }]
            }, {
                "@name": "s06",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "375",
                    "@value": "200"
                }, {
                    "@count": "4",
                    "@pph": "151",
                    "@value": "20"
                }, {
                    "@count": "3",
                    "@pph": "10",
                    "@value": "8"
                }],
                "Symbol": [{
                    "@id": "w01",
                    "@required": "false"
                }, {
                    "@id": "s06",
                    "@required": "false"
                }]
            }, {
                "@name": "s07",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "341",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "138",
                    "@value": "15"
                }, {
                    "@count": "3",
                    "@pph": "09",
                    "@value": "5"
                }],
                "Symbol": [{
                    "@id": "w01",
                    "@required": "false"
                }, {
                    "@id": "s07",
                    "@required": "false"
                }]
            }, {
                "@name": "s08",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "273",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "109",
                    "@value": "15"
                }, {
                    "@count": "3",
                    "@pph": "07",
                    "@value": "5"
                }],
                "Symbol": [{
                    "@id": "w01",
                    "@required": "false"
                }, {
                    "@id": "s08",
                    "@required": "false"
                }]
            }, {
                "@name": "s09",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "300",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "120",
                    "@value": "15"
                }, {
                    "@count": "3",
                    "@pph": "08",
                    "@value": "5"
                }],
                "Symbol": [{
                    "@id": "w01",
                    "@required": "false"
                }, {
                    "@id": "s09",
                    "@required": "false"
                }]
            }]
        }, {
            "@name": "PrizeInfoScatter",
            "@strategy": "PayExpandSymbolAny",
            "Prize": {
                "@name": "b01",
                "PrizePay": [{
                    "@count": "6",
                    "@pph": "33",
                    "@value": "0"
                }, {
                    "@count": "5",
                    "@pph": "07",
                    "@value": "0"
                }, {
                    "@count": "4",
                    "@pph": "02",
                    "@value": "2"
                }],
                "Symbol": {
                    "@id": "b01",
                    "@required": "true"
                }
            }
        }],
        "StripInfo": [{
            "@name": "BaseGame",
            "Strip": [{
                "@name": "Reel0",
                "#text": "s07,d03,s08,s07,s01,s02,s07,s09,s01,s07,d02,s08,s07,s09,d01,s07,s09,d05,s07,d04,s08,s09,d02,d05,s09,s06,s08,s09,s05,d04,s06,s07,s09,s06,s01,s04,s09,s07,s08,s09,s02,s08,s09,s06,w01,s09,s06,s05,s09,s08,s04,s09,s06,s08,s07,s09,d03,s07,s06,s08,s07,s03,s06,s07,s03,s06,s07,s08,s04,s06"
            }, {
                "@name": "Reel1",
                "#text": "s06,s09,b01,s06,s04,s07,s06,s01,s07,s06,s08,s07,s06,s02,d05,s06,s08,d03,s06,s08,s09,s06,s08,s07,s06,s09,s07,s06,s09,s03,s06,s09,b02,s06,s01,s09,s03,s07,s09,s08,s07,s02,s08,b02,d05,s08,b01,d04,s08,b01,s05,d04,s08,s07,s09,b02,s07,s06,s08,s07,s09,s08,s07,s06,s08,s09,s07,s08,s09,w01,s08,d02,s09,s06,b01,d01,s08"
            }, {
                "@name": "Reel2",
                "#text": "s06,d02,s05,s06,d01,s04,s06,d04,d01,s06,s07,d04,s09,b02,s03,s08,b02,d03,s01,d05,s08,s09,d05,s07,s01,w01,s06,d03,d01,s09,d04,b01,s08,d01,s07,d04,d03,s07,b01,s09,s07,d05,d02,s08,s07,d01,s08,s09,s07,d05,d01,d02,s06,d03,d02,d04,s09,s08,d03,b02,d02,s08,s06,d05,s09,d02,w01,s02"
            }, {
                "@name": "Reel3",
                "#text": "d05,s09,d04,d05,s06,d04,d05,s06,d03,d05,s06,d01,s02,w01,s05,s03,w01,s01,s09,s06,s03,s08,d01,b01,d02,d03,s08,s07,d05,b01,s09,s01,b01,d05,s04,w01,d01,d02,d04,b01,s07,s06,b02,d02,s07,s08,s05,s02,d01,s07,s08,s06,s01,s04,s03,s02,s08,s04,s01,b01,s03,d04,s01,d03,s05,b02,d02,d03,s07,d04,d02,w01,d04,d01,b01,s05,s09,s02,s04,d01,s03,s08,d05,s04,d03,s06,s09,d02,s08,d03,s02"
            }, {
                "@name": "Reel4",
                "#text": "w01,s01,d02,w01,s01,s06,w01,s02,s07,w01,s08,s09,w01,s02,s03,w01,s04,d03,d01,s08,d05,w01,d01,d05,w01,s03,s05,w01,d04,s09,d03,d04,w01,d02,s05,s07,s04,s06"
            }]
        }, {
            "@name": "FreeSpin",
            "Strip": [{
                "@name": "Reel0",
                "#text": "s06,s07,w01,s06,s09,s07,d13,s09,s06,d11,s08,s07,d14,d13,s06,d11,d12,s08,s09,d12,d10,s08,d14,s07,s08,d10,s09"
            }, {
                "@name": "Reel1",
                "#text": "s08,d14,s10,s08,s09,d12,s13,s09,d10,w01,s06,d13,s07,s14,s06,d12,d10,d14,s08,s07,d13,d11,s09,s06,d11,s09,s07,s08,s12,s11"
            }, {
                "@name": "Reel2",
                "#text": "s07,s06,s09,s07,s11,s09,s07,s08,s06,s07,s08,s14,s07,s08,w01,s07,s08,d11,s07,s08,s06,s09,s13,s08,s09,d12,s07,d10,s06,d13,d10,s06,s07,d12,s10,s06,s11,s08,s13,s12,s06,d14,s08,s09,s14,s12,s07,s09,d14,s08,s06,s09,d11,s06,s10,s09,s08,d13,s09"
            }, {
                "@name": "Reel3",
                "#text": "d10,s09,d14,d10,s08,s14,d10,d11,d13,s14,d10,s13,s07,d11,d14,s12,s09,d14,s08,s11,s10,d14,s13,s11,s12,d13,s07,d12,d13,s10,d12,d11,d13,s06,d11,d12,s06,w01,d12"
            }, {
                "@name": "Reel4",
                "#text": "w01,s10,d13,w01,s10,d14,w01,d10,s06,w01,d11,s08,w01,s06,d13,w01,d11,s14,w01,s13,s11,w01,d12,s09,s08,s12,d14,s07,d10,s14,d12,s07,s09,s12,s13,s11"
            }]
        }],
        "PatternSliderInfo": {
            "PatternInfo": {
                "@max": "30",
                "@min": "1",
                "Step": ["1", "3", "5", "9", "15", "30"]
            },
            "BetInfo": {
                "@max": "1000",
                "@min": "1",
                "Step": ["1", "2", "3", "5", "10", "20", "30", "50", "100", "200", "300", "500", "1000"]
            }
        },
        "AwardCapInfo": "25000000",
        "GameData": [{
            "@name": "s01"
        }, {
            "@name": "s02"
        }, {
            "@name": "s03"
        }, {
            "@name": "s04"
        }, {
            "@name": "s05"
        }, {
            "@name": "s10"
        }, {
            "@name": "s11"
        }, {
            "@name": "s12"
        }, {
            "@name": "s13"
        }, {
            "@name": "s14"
        }, {
            "@name": "w01"
        }],
        "DenominationList": "1.0",
        "GameBetInfo": {
            "MinChipValue": "1.0",
            "MinBet": "1.0",
            "MaxBet": "30.0"
        },
        "AutoSpinInfo": {
            "@enable": "True",
            "Step": ["10", "20", "30", "40", "50"]
        },
        "VersionInfo": {
            "GameLogicVersion": "1.0"
        }
    }
}';

        $this->outJSON($json);
    }

    protected function startInit($request) {
        $this->setSessionIfEmpty('state', 'SPIN');

        $balance = $this->getBalance();

        $state = 'BaseGame';
        if($_SESSION['state'] == 'FREE') {
            $state = 'FreeSpin';
        }

        $fs = '';
        $prize = '';
        if($_SESSION['state'] == 'FREE') {

            $balance = $_SESSION['startBalance'];

            $fs = '"FreeSpinOutcome": {
            "@name": "",
            "InitAwarded": "15",
            "Awarded": "0",
            "TotalAwarded": "'.$_SESSION['totalAwarded'].'",
            "Count": "'.$_SESSION['fsPlayed'].'",
            "Countdown": "'.$_SESSION['fsLeft'].'",
            "IncrementTriggered": "false",
            "MaxAwarded": "false",
            "MaxSpinsHit": "false"
        },';

            $prize = '"PrizeOutcome": [{
            "@multiplier": "1",
            "@name": "Game.Total",
            "@pay": "'.$_SESSION['fsTotalWin'].'",
            "@stage": "",
            "@totalPay": "'.$_SESSION['fsTotalWin'].'",
            "@type": "",
            "Prize": {
                "@betMultiplier": "1",
                "@multiplier": "1",
                "@name": "Total",
                "@pay": "'.$_SESSION['fsTotalWin'].'",
                "@payName": "",
                "@position": "0",
                "@symbolCount": "0",
                "@totalPay": "'.$_SESSION['fsTotalWin'].'",
                "@ways": "0"
            }
        }, {
            "@multiplier": "1",
            "@name": "FreeSpin.Total",
            "@pay": "'.$_SESSION['fsTotalWin'].'",
            "@stage": "",
            "@totalPay": "'.$_SESSION['fsTotalWin'].'",
            "@type": "",
            "Prize": {
                "@betMultiplier": "1",
                "@multiplier": "1",
                "@name": "Total",
                "@pay": "'.$_SESSION['fsTotalWin'].'",
                "@payName": "",
                "@position": "0",
                "@symbolCount": "0",
                "@totalPay": "'.$_SESSION['fsTotalWin'].'",
                "@ways": "0"
            }
        }],';
        }

        $patternsBet = $this->gameParams->defaultCoinsCount;
        $coinValue = $this->gameParams->default_coinvalue;
        if(!empty($_SESSION['lastPick'])) {
            $patternsBet = $_SESSION['lastPick'];
            $coinValue = $_SESSION['lastBet'] / $_SESSION['lastPick'];
        }

        $json = '{
    "ReturnStatus": {
        "Code": "1000000",
        "Message": "",
        "Debug": ""
    },
    "GameLogicResponse": {
        "OutcomeDetail": {
            "TransactionId": "A4310-14594825825152",
            "Stage": "'.$state.'",
            "NextStage": "'.$state.'",
            "Balance": "'.$balance.'",
            "GameStatus": "Initial",
            "Settled": "0",
            "Pending": "0",
            "Payout": "0"
        },
        '.$fs.$prize.'
        "PopulationOutcome": [{
            "@name": "BaseGame.Reels",
            "@stage": "BaseGame",
            "#text": "s07,s09,d01,s08,s07,s09,s02,s06,d02,s06,d04,d05,w01,s01,s06"
        }, {
            "@name": "FreeSpin.Reels",
            "@stage": "FreeSpin",
            "#text": "d12,d10,s08,s07,d13,d11,d10,s06,d13,s06,w01,d12,d14,s07,d10"
        }],
        "PatternSliderInput": {
            "BetPerPattern": "'.$coinValue.'",
            "PatternsBet": "'.$patternsBet.'"
        },
        "Balances": {
            "@totalBalance": "'.$balance.'",
            "Balance": {
                "@name": "FREE",
                "#text": "'.$balance.'"
            }
        }
    },
    "Paytable": {
        "PaytableStatistics": {
            "@description": "Cats 30L 3x3x3x3x3",
            "@maxRTP": "94.93",
            "@minRTP": "93.04",
            "@name": "Cats",
            "@type": "Slot"
        },
        "StripInfo": [{
            "@name": "BaseGame",
            "Strip": '.$this->getStripInfo(0).'
        }, {
            "@name": "FreeSpin",
            "Strip": '.$this->getStripInfo(1).'
        }],
        "PatternSliderInfo": {
            "PatternInfo": {
                "@max": "30",
                "@min": "1",
                "Step": ["1", "3", "5", "9", "15", "30"]
            },
            "BetInfo": {
                "@max": "1000",
                "@min": "1",
                "Step": ['.$this->getDenomination().']
            }
        },
        "AwardCapInfo": "25000000",
        "DenominationList": "1.0",
        "GameBetInfo": {
            "MinChipValue": "1.0",
            "MinBet": "1.0",
            "MaxBet": "30.0"
        }
    },
    "CURRENCY": {
        "@currencyCode": "'.$this->gameParams->curiso.'",
        "MAJOR_SYMBOL": ["'.$this->gameParams->currency.'"],
        "MINOR_SYMBOL": [],
        "MAJOR_SYMBOL_ALIGNMENT": "left",
        "MINOR_SYMBOL_ALIGNMENT": "right",
        "MAJOR_SYMBOL_PADDING_SPACE": "false",
        "MINOR_SYMBOL_PADDING_SPACE": "false",
        "DECIMAL_SEPARATOR": ".",
        "THOUSANDS_SEPARATOR": ",",
        "DECIMAL_PRECISION": "2",
        "USE_THOUSANDS_SEPARATOR": "no",
        "MINOR_CURRENCY_LOCK": "no",
        "CHIP_SET_CODE": "chipSet1"
    }
}';

        $this->outJSON($json);
    }

    protected function startSpin($request) {
        $totalBet = $request['GameLogicRequest']['PatternSliderInput']['PatternsBet'];
        $betPerLine = (float) $request['GameLogicRequest']['PatternSliderInput']['BetPerPattern'];

        $stake = $totalBet * $betPerLine;
        $pick = (int) $totalBet;

        $this->checkSpinAvailable($stake);

        $this->slot = new Slot($this->gameParams, $pick, $stake);

        $spinData = $this->getSpinData();
        $totalWin = $spinData['totalWin'];
        $respin = $spinData['respin'];

        while(!game_ctrl($stake * 100, $totalWin * 100) || $respin) {
            $spinData = $this->getSpinData();
            $totalWin = $spinData['totalWin'];
            $respin = $spinData['respin'];
        }

        $this->spinPays[] = array(
            'win' => $spinData['report']['spinWin'],
            'report' => $spinData['report'],
        );

        switch($spinData['report']['type']) {
            case 'SPIN':
                $this->showSpinReport($spinData['report'], $spinData['totalWin']);
                break;
            case 'FREE':
                $this->showStartFreeSpinReport($spinData['report'], $spinData['totalWin']);
                break;
        }

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];
        $this->startPay();
    }

    protected function startFreeSpin($request) {
        $stake = $_SESSION['lastBet'];
        $pick = $_SESSION['lastPick'];

        $this->slot = new Slot($this->gameParams, $pick, $stake);
        $this->slot->createCustomReels($this->gameParams->reels[1], array(3,3,3,3,3));

        $spinData = $this->getSpinData();
        $totalWin = $spinData['totalWin'];
        $respin = $spinData['respin'];

        while(!game_ctrl(0, $totalWin * 100) || $respin) {
            $spinData = $this->getSpinData();
            $totalWin = $spinData['totalWin'];
            $respin = $spinData['respin'];
        }

        $this->fsPays[] = array(
            'win' => $spinData['report']['spinWin'],
            'report' => $spinData['report'],
        );

        $this->showPlayFreeSpinReport($spinData['report'], $spinData['totalWin']);

        $_SESSION['lastBet'] = $stake;
        $_SESSION['lastPick'] = $pick;
        $_SESSION['lastStops'] = $spinData['report']['stops'];
        $this->startPay();
    }

    protected function getSpinData() {
        $this->spinPays = array();
        $this->fsPays = array();
        $this->bonusPays = array();

        $respin = false;

        $report = $this->slot->spin();

        $report['type'] = 'SPIN';

        $r1 = $this->slot->getSymbolAnyCount('b01');
        $r2 = $this->slot->getSymbolAnyCount('b02');

        $totalCount = $r1['count'] + $r2['count'] * 2;

        $report['scattersReport'] = array();
        $report['scattersReport']['count'] = $totalCount;
        $report['scattersReport']['offsets'] = array_merge($r1['offsets'], $r2['offsets']);
        $report['scattersReport']['totalWin'] = 0;
        if($totalCount == 4) {
            $report['scattersReport']['totalWin'] = $report['bet'] * 2;
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];
        }

        if($totalCount > 4) {
            $report['type'] = 'FREE';
        }

        if(empty($report['winLines']) || $totalCount < 5) {
            //$respin = true;
        }

        $totalWin = $report['totalWin'];

        return array(
            'totalWin' => $totalWin,
            'report' => $report,
            'respin' => $respin,
        );
    }

    protected function showSpinReport($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $display = $this->getDisplay($report);

        $scatterHighlight = $this->getScattersHighlight($report['scattersReport'], 'BaseGame.Scatter', 0, true);
        $highlight = $this->getHighlight($report['winLines']);

        $scatterWin = $this->getScattersPay($report['scattersReport']);
        $winLines = $this->getWinLines($report);

        $winLines = str_replace('d01', 's01', $winLines);
        $winLines = str_replace('d02', 's02', $winLines);
        $winLines = str_replace('d03', 's03', $winLines);
        $winLines = str_replace('d04', 's04', $winLines);
        $winLines = str_replace('d05', 's05', $winLines);

        $json = '{
    "ReturnStatus": {
        "Code": "1000000",
        "Message": "",
        "Debug": ""
    },
    "GameLogicResponse": {
        "OutcomeDetail": {
            "TransactionId": "R0340-14353481221356",
            "Stage": "BaseGame",
            "NextStage": "BaseGame",
            "Balance": "'.$balance.'",
            "GameStatus": "Start",
            "Settled": "'.$report['bet'].'",
            "Pending": "0",
            "Payout": "'.$totalWin.'"
        },
        "FreeSpinOutcome": {
            "@name": "",
            "InitAwarded": "0",
            "Awarded": "0",
            "TotalAwarded": "0",
            "Count": "0",
            "Countdown": "0",
            "IncrementTriggered": "false",
            "MaxAwarded": "false",
            "MaxSpinsHit": "false"
        },
        "PopulationOutcome": [{
            "@name": "BaseGame.Reels",
            "@stage": "BaseGame",
            "#text": "'.$display.'"
        }, {
            "@name": "FreeSpin.Reels",
            "@stage": "FreeSpin",
            "#text": "d12,d10,s08,s07,d13,d11,d10,s06,d13,s06,w01,d12,d14,s07,d10"
        }],
        "AwardCapOutcome": {
            "@name": "AwardCap",
            "AwardCapExceeded": "false"
        },
        "HighlightOutcome": ['.$scatterHighlight.', '.$highlight.'],
        "PrizeOutcome": ['.$scatterWin.', '.$winLines.', {
            "@multiplier": "1",
            "@name": "Game.Total",
            "@pay": "'.$totalWin.'",
            "@stage": "",
            "@totalPay": "'.$totalWin.'",
            "@type": "",
            "Prize": {
                "@betMultiplier": "1",
                "@multiplier": "1",
                "@name": "Total",
                "@pay": "'.$totalWin.'",
                "@payName": "",
                "@position": "0",
                "@symbolCount": "0",
                "@totalPay": "'.$totalWin.'",
                "@ways": "0"
            }
        }],
        "ActionInput": {
            "Action": "play"
        },
        "PatternSliderInput": {
            "BetPerPattern": "'.$this->slot->betOnLine.'",
            "PatternsBet": "'.$this->slot->linesCount.'"
        },
        "TransactionId": "A4310-14594825789242",
        "Balances": {
            "@totalBalance": "'.$balance.'",
            "Balance": {
                "@name": "FREE",
                "#text": "'.$balance.'"
            }
        }
    }
}';


        $this->outJSON($json);
    }



    protected function showStartFreeSpinReport($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $display = $this->getDisplay($report);

        $scatterHighlight = $this->getScattersHighlight($report['scattersReport'], 'BaseGame.Scatter', 0, false);
        $highlight = $this->getHighlight($report['winLines']);

        $scatterWin = $this->getScattersPay($report['scattersReport'], 'BaseGame.Scatter', 'b01', true);
        $winLines = $this->getWinLines($report);

        $winLines = str_replace('d01', 's01', $winLines);
        $winLines = str_replace('d02', 's02', $winLines);
        $winLines = str_replace('d03', 's03', $winLines);
        $winLines = str_replace('d04', 's04', $winLines);
        $winLines = str_replace('d05', 's05', $winLines);

        $_SESSION['baseWinLinesWin'] = $report['totalWin'] - $report['scattersReport']['totalWin'];
        $_SESSION['startBalance'] = $balance-$totalWin;
        $_SESSION['fsTotalWin'] = $report['scattersReport']['totalWin'];
        $_SESSION['scatterWin'] = $report['scattersReport']['totalWin'];

        $awarded = 5;
        if($report['scattersReport']['count'] == 6) {
            $awarded = 10;
        }

        $_SESSION['state'] = 'FREE';
        $_SESSION['totalAwarded'] = $awarded;
        $_SESSION['fsLeft'] = $awarded;
        $_SESSION['fsPlayed'] = 0;

        $_SESSION['baseDisplay'] = base64_encode(gzcompress($display, 9));
        $_SESSION['baseScatterPay'] = base64_encode(gzcompress($scatterWin, 9));
        $_SESSION['baseScatterHighlight'] = base64_encode(gzcompress($scatterHighlight, 9));
        $_SESSION['baseHighlight'] = base64_encode(gzcompress($highlight, 9));
        $_SESSION['baseWinLines'] = base64_encode(gzcompress($winLines, 9));




        $json = '{
    "ReturnStatus": {
        "Code": "1000000",
        "Message": "",
        "Debug": ""
    },
    "GameLogicResponse": {
        "OutcomeDetail": {
            "TransactionId": "R0340-14353466481516",
            "Stage": "BaseGame",
            "NextStage": "FreeSpin",
            "Balance": "'.$_SESSION['startBalance'].'",
            "GameStatus": "InProgress",
            "Settled": "0",
            "Pending": "'.$report['bet'].'",
            "Payout": "0"
        },
        "FreeSpinOutcome": {
            "@name": "",
            "InitAwarded": "'.$_SESSION['totalAwarded'].'",
            "Awarded": "'.$_SESSION['totalAwarded'].'",
            "TotalAwarded": "'.$_SESSION['totalAwarded'].'",
            "Count": "0",
            "Countdown": "'.$_SESSION['totalAwarded'].'",
            "IncrementTriggered": "true",
            "MaxAwarded": "false",
            "MaxSpinsHit": "false"
        },
        "PopulationOutcome": [{
            "@name": "BaseGame.Reels",
            "@stage": "BaseGame",
            "#text": "'.$display.'"
        }, {
            "@name": "FreeSpin.Reels",
            "@stage": "FreeSpin",
            "#text": "b01,s08,s09,s03,s07,s01,w01,s08,s10,s06,s02,s11,s04,s10,s05"
        }],
        "AwardCapOutcome": {
            "@name": "AwardCap",
            "AwardCapExceeded": "false"
        },
        "HighlightOutcome": ['.$scatterHighlight.', '.$highlight.'],
        "TriggerOutcome": {
            "@component": "",
            "@name": "FreeSpin",
            "@stage": ""
        },
        "PrizeOutcome": ['.$scatterWin.', '.$winLines.', {
            "@multiplier": "1",
            "@name": "Game.Total",
            "@pay": "'.$totalWin.'",
            "@stage": "",
            "@totalPay": "'.$totalWin.'",
            "@type": "",
            "Prize": {
                "@betMultiplier": "1",
                "@multiplier": "1",
                "@name": "Total",
                "@pay": "'.$totalWin.'",
                "@payName": "",
                "@position": "0",
                "@symbolCount": "0",
                "@totalPay": "'.$totalWin.'",
                "@ways": "0"
            }
        }],
        "ActionInput": {
            "Action": "play"
        },
        "PatternSliderInput": {
            "BetPerPattern": "'.$this->slot->betOnLine.'",
            "PatternsBet": "'.$this->slot->linesCount.'"
        },
        "TransactionId": "A4510-14585366448626",
        "Balances": {
            "@totalBalance": "'.$balance.'",
            "Balance": {
                "@name": "FREE",
                "#text": "'.$balance.'"
            }
        }
    }
}';

        $this->outJSON($json);
    }

    protected function showPlayFreeSpinReport($report, $totalWin) {
        $balance = $this->getBalance() - $report['bet'] + $totalWin;
        $display = $this->getDisplay($report);
        $scatterHighlight = $this->getScattersHighlight($report['scattersReport'], 'FreeSpin.Scatter', 0, true);
        $highlight = $this->getHighlight($report['winLines'], 'FreeSpin.Lines');
        $scatterWin = $this->getScattersPay($report['scattersReport'], 'FreeSpin.Scatter');
        $winLines = $this->getWinLines($report, 'FreeSpin');

        $winLines = str_replace('d10', 's10', $winLines);
        $winLines = str_replace('d11', 's11', $winLines);
        $winLines = str_replace('d12', 's12', $winLines);
        $winLines = str_replace('d13', 's13', $winLines);
        $winLines = str_replace('d14', 's14', $winLines);



        $awarded = 0;


        $_SESSION['fsPlayed']++;
        $_SESSION['fsLeft']--;
        $_SESSION['fsTotalWin'] += $totalWin;

        $needBalance = $_SESSION['startBalance'];
        $nextStage = 'FreeSpin';
        $payout = 0;
        $settled = 0;
        $pending = $report['bet'];
        $gameStatus = 'InProgress';
        $baseDisplay = gzuncompress(base64_decode($_SESSION['baseDisplay']));
        $baseH = '';
        $baseP = '';
        if($_SESSION['fsLeft'] == 0) {
            $nextStage = 'BaseGame';
            $needBalance = $_SESSION['startBalance'] + $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'];
            $payout = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'];
            $settled = $report['bet'];
            $pending = 0;
            $gameStatus = 'Start';

            $baseScatterPay = gzuncompress(base64_decode($_SESSION['baseScatterPay']));
            $baseScatterHighlight = gzuncompress(base64_decode($_SESSION['baseScatterHighlight']));
            $baseHighlight = gzuncompress(base64_decode($_SESSION['baseHighlight']));
            $baseWinLines = gzuncompress(base64_decode($_SESSION['baseWinLines']));

            $baseH = $baseScatterHighlight.', '.$baseHighlight.', ';
            $baseP = $baseScatterPay.', '.$baseWinLines.', ';
        }

        $fsWin = $_SESSION['fsTotalWin'] - $_SESSION['scatterWin'];
        $gameTotal = $_SESSION['fsTotalWin'] + $_SESSION['baseWinLinesWin'];
        if($gameTotal < 0) {
            $gameTotal = 0;
        }

        $json = '{
    "ReturnStatus": {
        "Code": "1000000",
        "Message": "",
        "Debug": ""
    },
    "GameLogicResponse": {
        "OutcomeDetail": {
            "TransactionId": "R0340-14353466481516",
            "Stage": "FreeSpin",
            "NextStage": "'.$nextStage.'",
            "Balance": "'.$needBalance.'",
            "GameStatus": "'.$gameStatus.'",
            "Settled": "'.$settled.'",
            "Pending": "'.$pending.'",
            "Payout": "'.$payout.'"
        },
        "FreeSpinOutcome": {
            "@name": "",
            "InitAwarded": "5",
            "Awarded": "'.$awarded.'",
            "TotalAwarded": "'.$_SESSION['totalAwarded'].'",
            "Count": "'.$_SESSION['fsPlayed'].'",
            "Countdown": "'.$_SESSION['fsLeft'].'",
            "IncrementTriggered": "'.(($awarded == 1) ? 'true' : 'false').'",
            "MaxAwarded": "false",
            "MaxSpinsHit": "false"
        },
        "PopulationOutcome": [{
            "@name": "FreeSpin.Reels",
            "@stage": "FreeSpin",
            "#text": "'.$display.'"
        }, {
            "@name": "BaseGame.Reels",
            "@stage": "BaseGame",
            "#text": "'.$baseDisplay.'"
        }],
        "AwardCapOutcome": {
            "@name": "AwardCap",
            "AwardCapExceeded": "false"
        },
        "HighlightOutcome": ['.$baseH.$scatterHighlight.', '.$highlight.'],
        "PrizeOutcome": ['.$baseP.$scatterWin.', '.$winLines.', {
            "@multiplier": "1",
            "@name": "Game.Total",
            "@pay": "'.$gameTotal.'",
            "@stage": "",
            "@totalPay": "'.$gameTotal.'",
            "@type": "",
            "Prize": {
                "@betMultiplier": "1",
                "@multiplier": "1",
                "@name": "Total",
                "@pay": "'.$gameTotal.'",
                "@payName": "",
                "@position": "0",
                "@symbolCount": "0",
                "@totalPay": "'.$gameTotal.'",
                "@ways": "0"
            }
        }, {
            "@multiplier": "1",
            "@name": "FreeSpin.Total",
            "@pay": "'.$fsWin.'",
            "@stage": "",
            "@totalPay": "'.$fsWin.'",
            "@type": "",
            "Prize": {
                "@betMultiplier": "1",
                "@multiplier": "1",
                "@name": "Total",
                "@pay": "'.$fsWin.'",
                "@payName": "",
                "@position": "0",
                "@symbolCount": "0",
                "@totalPay": "'.$fsWin.'",
                "@ways": "0"
            }
        }],
        "ActionInput": {
            "Action": "play"
        },
        "PatternSliderInput": {
            "BetPerPattern": "'.$this->slot->betOnLine.'",
            "PatternsBet": "'.$this->slot->linesCount.'"
        },
        "TransactionId": "A4510-14585366448626",
        "Balances": {
            "@totalBalance": "'.$balance.'",
            "Balance": {
                "@name": "FREE",
                "#text": "'.$balance.'"
            }
        }
    }
}';
        $this->outJSON($json);

        if($_SESSION['fsLeft'] == 0) {
            $_SESSION['state'] = 'SPIN';
            unset($_SESSION['fsLeft']);
            unset($_SESSION['fsPlayed']);
            unset($_SESSION['totalAwarded']);
            unset($_SESSION['scatterWin']);
            unset($_SESSION['fsTotalWin']);
            unset($_SESSION['startBalance']);
            unset($_SESSION['baseDisplay']);
            unset($_SESSION['baseWinLinesWin']);
            unset($_SESSION['baseScatterPay']);
            unset($_SESSION['baseScatterHighlight']);
            unset($_SESSION['baseHighlight']);
            unset($_SESSION['baseWinLines']);
        }
    }

}