<?
require_once('IGTMobileCtrl.php');

class cleopatra_mobileCtrl extends IGTMobileCtrl {

    protected function startPaytable($request) {
        $json = '{
    "ReturnStatus": {
        "Code": "1000000",
        "Message": "",
        "Debug": ""
    },
    "Paytable": {
        "PaytableStatistics": {
            "@description": "Cleopatra 20L 3x3x3x3x3",
            "@maxRTP": "95.02",
            "@minRTP": "95.02",
            "@name": "Cleopatra",
            "@type": "Slot"
        },
        "AwardCapInfo": "25000000",
        "PrizeInfo": {
            "@name": "PrizeInfoLines",
            "@strategy": "PayLeft",
            "Prize": [{
                "@name": "w01",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "16605000",
                    "@value": "10000"
                }, {
                    "@count": "4",
                    "@pph": "851538",
                    "@value": "2000"
                }, {
                    "@count": "3",
                    "@pph": "39209",
                    "@value": "200"
                }, {
                    "@count": "2",
                    "@pph": "27000",
                    "@value": "10"
                }],
                "Symbol": {
                    "@id": "w01",
                    "@required": "true"
                }
            }, {
                "@name": "s01",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "156651",
                    "@value": "750"
                }, {
                    "@count": "4",
                    "@pph": "16935",
                    "@value": "100"
                }, {
                    "@count": "3",
                    "@pph": "1113",
                    "@value": "25"
                }, {
                    "@count": "2",
                    "@pph": "125",
                    "@value": "2"
                }],
                "Symbol": [{
                    "@id": "w01",
                    "@required": "false"
                }, {
                    "@id": "s01",
                    "@required": "false"
                }]
            }, {
                "@name": "s02",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "156651",
                    "@value": "750"
                }, {
                    "@count": "4",
                    "@pph": "16935",
                    "@value": "100"
                }, {
                    "@count": "3",
                    "@pph": "1765",
                    "@value": "25"
                }, {
                    "@count": "2",
                    "@pph": "121",
                    "@value": "2"
                }],
                "Symbol": [{
                    "@id": "w01",
                    "@required": "false"
                }, {
                    "@id": "s02",
                    "@required": "false"
                }]
            }, {
                "@name": "s03",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "83025",
                    "@value": "400"
                }, {
                    "@count": "4",
                    "@pph": "11531",
                    "@value": "100"
                }, {
                    "@count": "3",
                    "@pph": "1154",
                    "@value": "15"
                }],
                "Symbol": [{
                    "@id": "w01",
                    "@required": "false"
                }, {
                    "@id": "s03",
                    "@required": "false"
                }]
            }, {
                "@name": "s04",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "62075",
                    "@value": "250"
                }, {
                    "@count": "4",
                    "@pph": "8870",
                    "@value": "75"
                }, {
                    "@count": "3",
                    "@pph": "1198",
                    "@value": "10"
                }],
                "Symbol": [{
                    "@id": "w01",
                    "@required": "false"
                }, {
                    "@id": "s04",
                    "@required": "false"
                }]
            }, {
                "@name": "s05",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "83025",
                    "@value": "250"
                }, {
                    "@count": "4",
                    "@pph": "11827",
                    "@value": "50"
                }, {
                    "@count": "3",
                    "@pph": "1154",
                    "@value": "10"
                }],
                "Symbol": [{
                    "@id": "w01",
                    "@required": "false"
                }, {
                    "@id": "s05",
                    "@required": "false"
                }]
            }, {
                "@name": "s06",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "41306",
                    "@value": "125"
                }, {
                    "@count": "4",
                    "@pph": "7299",
                    "@value": "50"
                }, {
                    "@count": "3",
                    "@pph": "1246",
                    "@value": "10"
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
                    "@pph": "49567",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "6989",
                    "@value": "50"
                }, {
                    "@count": "3",
                    "@pph": "682",
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
                    "@pph": "17136",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "2956",
                    "@value": "25"
                }, {
                    "@count": "3",
                    "@pph": "280",
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
                    "@pph": "20576",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "3581",
                    "@value": "25"
                }, {
                    "@count": "3",
                    "@pph": "611",
                    "@value": "5"
                }],
                "Symbol": [{
                    "@id": "w01",
                    "@required": "false"
                }, {
                    "@id": "s09",
                    "@required": "false"
                }]
            }, {
                "@name": "s10",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "13215",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "2744",
                    "@value": "25"
                }, {
                    "@count": "3",
                    "@pph": "350",
                    "@value": "5"
                }],
                "Symbol": [{
                    "@id": "w01",
                    "@required": "false"
                }, {
                    "@id": "s10",
                    "@required": "false"
                }]
            }, {
                "@name": "s11",
                "PrizePay": [{
                    "@count": "5",
                    "@pph": "22066",
                    "@value": "100"
                }, {
                    "@count": "4",
                    "@pph": "4607",
                    "@value": "25"
                }, {
                    "@count": "3",
                    "@pph": "588",
                    "@value": "5"
                }, {
                    "@count": "2",
                    "@pph": "141",
                    "@value": "2"
                }],
                "Symbol": [{
                    "@id": "w01",
                    "@required": "false"
                }, {
                    "@id": "s10",
                    "@required": "false"
                }]
            }]
        },
        "PatternSliderInfo": {
            "PatternInfo": {
                "@max": "20",
                "@min": "1",
                "Step": ["1", "5", "9", "15", "20"]
            },
            "BetInfo": {
                "@max": "1000",
                "@min": "1",
                "Step": ["1", "2", "3", "5", "10", "20", "30", "50", "100", "200", "300", "500", "1000"]
            }
        },
        "StripInfo": [{
            "@name": "ReelStripList",
            "Strip": [{
                "@name": "Reel0",
                "#text": "b01,s08,s09,w01,s08,s06,s02,s07,s01,s08,s05,s07,s04,s10,s01,s11,s03,s10,s05,s08,s10,s03,s09,s06,s04,s10,s08,s02,s11,s10"
            }, {
                "@name": "Reel1",
                "#text": "s05,s11,s08,s03,s07,s01,s09,s02,s10,s01,s11,b01,s06,s04,s10,s07,s02,s09,s08,s05,s09,s04,s08,s09,s03,s08,s06,w01,s08,s09"
            }, {
                "@name": "Reel2",
                "#text": "s03,s07,s09,w01,s08,s10,s03,s11,s09,s01,s06,s10,s04,s06,s07,s01,s11,s10,s02,s08,s11,s04,s07,s05,s11,b01,s07,s11,s05,s10"
            }, {
                "@name": "Reel3",
                "#text": "s04,s11,s06,s02,s11,s06,w01,s07,s11,s05,s06,s02,s09,s01,s10,s04,s09,s03,s08,s05,s09,s10,s04,s06,s08,b01,s10,s07,s03,s09"
            }, {
                "@name": "Reel4",
                "#text": "s02,s07,s10,w01,s07,s11,s01,s10,s05,s06,s09,b01,s11,s06,s04,s08,s06,s04,s10,s05,s08,s03,s11,w01,s09,s02,s08,s07,s05,s09,s10,s03,s08,s04,s11,s01,s06,s11,s03,s10,s09"
            }]
        }, {
            "@name": "FreeSpin.ReelStripList",
            "Strip": [{
                "@name": "Reel0",
                "#text": "b01,s08,s09,w01,s08,s06,s02,s07,s01,s08,s05,s07,s04,s10,s01,s11,s03,s10,s05,s08,s10,s03,s09,s06,s04,s10,s08,s02,s11,s10"
            }, {
                "@name": "Reel1",
                "#text": "s05,s11,s08,s03,s07,s01,s09,s02,s10,s01,s11,b01,s06,s04,s10,s07,s02,s09,s08,s05,s09,s04,s08,s09,s03,s08,s06,w01,s08,s09"
            }, {
                "@name": "Reel2",
                "#text": "s03,s07,s09,w01,s08,s10,s03,s11,s09,s01,s06,s10,s04,s06,s07,s01,s11,s10,s02,s08,s11,s04,s07,s05,s11,b01,s07,s11,s05,s10"
            }, {
                "@name": "Reel3",
                "#text": "s04,s11,s06,s02,s11,s06,w01,s07,s11,s05,s06,s02,s09,s01,s10,s04,s09,s03,s08,s05,s09,s10,s04,s06,s08,b01,s10,s07,s03,s09"
            }, {
                "@name": "Reel4",
                "#text": "s02,s07,s10,w01,s07,s11,s01,s10,s05,s06,s09,b01,s11,s06,s04,s08,s06,s04,s10,s05,s08,s03,s11,w01,s09,s02,s08,s07,s05,s09,s10,s03,s08,s04,s11,s01,s06,s11,s03,s10,s09"
            }]
        }],
        "StepInfo": {
            "@name": "AutoSpin",
            "Step": ["5", "10", "15", "20", "25"]
        },
        "MaxFreeSpins": " 180  ",
        "DenominationList": "1.0",
        "GameBetInfo": {
            "MinChipValue": "1.0",
            "MinBet": "1.0",
            "MaxBet": "100.0"
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

            $fsWin = $_SESSION['fsTotalWin'] - $_SESSION['scatterWin'];

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
            "TransactionId": "A4310-14594825789242",
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
            "#text": "b01,s08,s09,s03,s07,s01,w01,s08,s10,s06,s02,s11,s04,s10,s05"
        }, {
            "@name": "FreeSpin.Reels",
            "@stage": "FreeSpin",
            "#text": "b01,s08,s09,s03,s07,s01,w01,s08,s10,s06,s02,s11,s04,s10,s05"
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
            "@description": "Cleopatra 20L 3x3x3x3x3",
            "@maxRTP": "95.02",
            "@minRTP": "95.02",
            "@name": "Cleopatra",
            "@type": "Slot"
        },
        "AwardCapInfo": "25000000",
        "PatternSliderInfo": {
            "PatternInfo": {
                "@max": "20",
                "@min": "1",
                "Step": ["1", "5", "9", "15", "20"]
            },
            "BetInfo": {
                "@max": "1000",
                "@min": "1",
                "Step": ['.$this->getDenomination().']
            }
        },
        "StripInfo": [{
            "@name": "ReelStripList",
            "Strip": '.$this->getStripInfo(0).'
        }, {
            "@name": "FreeSpin.ReelStripList",
            "Strip": '.$this->getStripInfo(1).'
        }],
        "DenominationList": "1.0",
        "GameBetInfo": {
            "MinChipValue": "1.0",
            "MinBet": "1.0",
            "MaxBet": "100.0"
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

        $bonus = array();

        if($_SESSION['state'] == 'FREE') {
            $bonus = array(
                'type' => 'multiple',
                'range' => array(3,3,),
            );
        }

        $report = $this->slot->spin($bonus);

        $report['type'] = 'SPIN';

        $report['scattersReport'] = $this->slot->getScattersCount();

        if($report['scattersReport']['count'] > 1) {
            $report['scattersReport']['totalWin'] = $report['bet'] * $this->gameParams->scatterMultiple[$report['scattersReport']['count']];
            if($_SESSION['state'] == 'FREE') {
                $report['scattersReport']['totalWin'] *= 3;
            }
            $report['totalWin'] += $report['scattersReport']['totalWin'];
            $report['spinWin'] += $report['scattersReport']['totalWin'];
            if($report['scattersReport']['count'] >= 3) {
                $report['type'] = 'FREE';
            }
        }

        if($report['scattersReport']['count'] < 3) {
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

        $scatterHighlight = $this->getScattersHighlight($report['scattersReport']);
        $highlight = $this->getHighlight($report['winLines']);

        $scatterWin = $this->getScattersPay($report['scattersReport']);
        $winLines = $this->getWinLines($report);

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

        $scatterHighlight = $this->getScattersHighlight($report['scattersReport']);
        $highlight = $this->getHighlight($report['winLines']);

        $scatterWin = $this->getScattersPay($report['scattersReport'], 'BaseGame.Scatter', 'b01', true);
        $winLines = $this->getWinLines($report);

        $_SESSION['baseWinLinesWin'] = $report['totalWin'] - $report['scattersReport']['totalWin'];
        $_SESSION['startBalance'] = $balance-$totalWin;
        $_SESSION['fsTotalWin'] = $report['scattersReport']['totalWin'];
        $_SESSION['scatterWin'] = $report['scattersReport']['totalWin'];

        $_SESSION['bonusWIN'] = $_SESSION['fsTotalWin'];

        $_SESSION['state'] = 'FREE';
        $_SESSION['totalAwarded'] = 15;
        $_SESSION['fsLeft'] = 15;
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
        $scatterHighlight = $this->getScattersHighlight($report['scattersReport'], 'FreeSpin.Scatter');
        $highlight = $this->getHighlight($report['winLines'], 'FreeSpin.Lines');
        $scatterWin = $this->getScattersPay($report['scattersReport'], 'FreeSpin.Scatter');
        $winLines = $this->getWinLines($report, 'FreeSpin');



        $awarded = 0;
        if($report['scattersReport']['count'] > 2) {
            $_SESSION['totalAwarded'] += 15;
            $_SESSION['fsLeft'] += 15;
            $awarded = 15;
        }


        $_SESSION['fsPlayed']++;
        $_SESSION['fsLeft']--;
        $_SESSION['fsTotalWin'] += $totalWin;

        $_SESSION['bonusWIN'] = $_SESSION['fsTotalWin'];

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
            "InitAwarded": "15",
            "Awarded": "'.$awarded.'",
            "TotalAwarded": "'.$_SESSION['totalAwarded'].'",
            "Count": "'.$_SESSION['fsPlayed'].'",
            "Countdown": "'.$_SESSION['fsLeft'].'",
            "IncrementTriggered": "'.(($awarded == 15) ? 'true' : 'false').'",
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
        "TriggerOutcome": {
            "@component": "",
            "@name": "FreeSpin",
            "@stage": ""
        },
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
            unset($_SESSION['bonusWIN']);
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