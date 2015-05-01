/*
* Model properties
*    eventPhase - indicates which phase of the GameEvent LifeCycle the game is in. It can have the following values:
*       initNextStage - Called once the game has started and when the game is about to begin a new stage (base game, free *			spin, bonus, etc.).
*       requestOutcome - Called when the game is requesting a new outcome.
*       outcomeReceived - Called once the game receives a new outcome.
*       showFinalOutcome - Called once the game has completely processed a new outcome. This phase can be depended on *			   having the full paid and balance values.
*       enableControls - Indicates that the game is ready for user input.
*       wagerChanged - Indicates that the player has changed his/her bet. 
*       updateBalance - Indicates that a change to the balance (due to cashier buyin/cashout) has been processed.
*    	payout - Indicates that a payout is occurring. This phase often occurs multiple times for a winning game *		 transaction in order to enhance the payout celebration by incrementing the paid amount.
*
*    balance - the player's current display balance
*    bet - the player's current bet
*    paid - the player's winnings from the last game outcome (note - this will often increment over time to enhance the *           award celebration)
*    denomination - the player's currently selected denomination
*    availableDenominations - a list of all available denominations for the game
*    transactionID - string used by rgs to reference the request from the client.
*    currencyCode - string representing the currency for which the game is being played (USD, GBP, EUR, etc.)
*    language - string representing the language used for localization (en, fr, zh, etc.)
*
*/



/*
*    Methods used by the game to push data to the console. Consoles should use ExternalInteface.addCallback to listen to *    these functions.
*/

// Pushed the new state of the game data
function F2FH_updateGameData(model)
{
  var gameSWF = getGPELauncher();
  gameSWF.FH2F_updateGameData(model);
  return true;
}

function F2FH_updateGameTransaction(model)
{
  var gameSWF = getGPELauncher();
  gameSWF.FH2F_updateGameTransaction(model);
}

// Push updates to volume
function F2FH_updateVolume(volume)
{
  var gameSWF = getGPELauncher();
  gameSWF.FH2F_updateVolume(volume);
}

// Pushes update to inform of the current enable/disable state of the audio
function F2FH_updateAudioEnabled(enabled)
{
   var gameSWF = getGPELauncher();
   gameSWF.FH2F_updateAudioEnabled(enabled);
}


// Pushes update to the balance - this is called after a cashier transaction is complete
function F2FH_updateBalance(balance)
{
   var gameSWF = getGPELauncher();
   gameSWF.FH2F_updateBalance(balance);
}

/*
* Methods provided by the game to allow the console to query data.
*/

// Used to query game data
function F2FH_getGameData()
{
  var gameSWF = getGPELauncher();
  return gameSWF.FH2F_getGameData();
}

// Used to query the Application.application.parameters within GPE
function F2FH_getFlashParams()
{
   var gameSWF = getGPELauncher();
   return gameSWF.FH2F_getFlashParams();
}
// Used to query volume of GPE
function F2FH_getVolume()
{
  var gameSWF = getGPELauncher();
  return gameSWF.FH2F_getVolume();
}

// Queries the current enable/disables state of the audio
function F2FH_getAudioEnabled()
{
   var gameSWF = getGPELauncher();
   return gameSWF.FH2F_getAudioEnabled();
}


/*
* Methods provided by the game to allow the client to change aspects of the game.
*/ 

// Request a change in volume
function F2FH_changeVolume(volume)
{
  var gameSWF = getGPELauncher();
  gameSWF.FH2F_changeVolume(volume);
}

// Request to change the current denomination
function F2FH_changeDenomination(denomination)
{
  var gameSWF = getGPELauncher();
  gameSWF.FH2F_changeDenomination(denomination);
}

// Request to open the paytable
function F2FH_requestPaytable() 
{
   var gameSWF = getGPELauncher();
   gameSWF.FH2F_requestPaytable();
}

// Request to open the help page
function F2FH_requestHelpPage()
{
   var gameSWF = getGPELauncher();
   gameSWF.FH2F_requestHelpPage();
}

// Request made by the console to the game to enable/disable audio
function F2FH_changeAudioEnabled(enabled)
{
   var gameSWF = getGPELauncher();
   gameSWF.FH2F_changeAudioEnabled(enabled);
}

// Request made by the 3rd party (such as Barcrest) to show an error within GPE
function F2FH_showError(errorCode)
{
   var gameSWF = getGPELauncher();
   gameSWF.FH2F_showError(errorCode);
}
// Request made by the 3rd party (such as Barcrest) to processes in game xml
// messages should be xml or xmllist sent as a string
function F2FH_processMessages(messages)
{
    var gameSWF = getGPELauncher();
    gameSWF.FH2F_processMessages(messages);
}

// Call made by GPE to inform 3rd party (such as Barcrest) that the messages have been processed
function F2FH_messageProcessingComplete()
{
    var gameSWF = getGPELauncher();
    gameSWF.FH2F_messageProcessingComplete();
}
/*******************************************************************************
 * These calls are made from the console to request a cashier buy in or cash out
 * The flow is Console -->Flash Host-->Console View
 *******************************************************************************/

function F2FH_requestCashier(balance)
{
    var gameSWF = getGPELauncher();
    gameSWF.FH2F_requestCashier(balance);
}

function F2FH_requestCashOut(balance)
{
    var gameSWF = getGPELauncher();
    gameSWF.FH2F_requestCashOut(balance);
}

function F2FH_requestBuyIn(balance)
{
    var gameSWF = getGPELauncher();
    gameSWF.FH2F_requestBuyIn(balance);
}

/* Functions called from GPE/FGAP


* Used to communicate between the cashier and GPE.  Cashier can either be an "internal" flash
* cashier or an "external" native system cashier
* The functions to open the cashier can be overwritten in the casino skin custom JavaScript file
*/

/*******************************************************************************
 * These functions need to be overwritten by the custom js if an "external" 
 * native system cashier is used.  These functions are called from the Cashier View
 * The flow is Cashier View --> Flash Host --> Cashier
 * 
 *******************************************************************************/
 
function F2FH_launchCashier(balance, nsURL)
{
    if (nsURL == null || nsURL == "null" || nsURL == "")
    {
        var gameSWF = getGPELauncher();
        gameSWF.FH2F_launchCashier(balance);
    }
    else
    {
        openNativeSystemCashier(nsURL,balance)
    }
}

function F2FH_launchBuyIn(balance, nsURL)
{
    if (nsURL == null || nsURL == "null" || nsURL == "")
    {
        var gameSWF = getGPELauncher();
        gameSWF.FH2F_launchBuyIn(balance);
    }
    else
    {
        openNativeSystemCashier(nsURL,balance)
    }
}

function F2FH_launchCashOut(balance, nsURL)
{
    if (nsURL == null || nsURL == "null" || nsURL == "")
    {
        var gameSWF = getGPELauncher();
        gameSWF.FH2F_launchCashOut(balance);
    }
    else
    {
        openNativeSystemCashier(nsURL,balance)
    }
}

/*******************************************************************************
 * These functions are called from the "internal" flash cashier.
 * The flow is Cashier-->Flash Host-->Cashier View 
 *******************************************************************************/
function F2FH_addFunds(amount)
{
    var gameSWF = getGPELauncher();
    gameSWF.FH2F_addFunds(amount);
}

function F2FH_removeFunds(amount)
{
    var gameSWF = getGPELauncher();
    gameSWF.FH2F_removeFunds(amount);
}

function F2FH_cancelCashier()
{
    var gameSWF = getGPELauncher();
    gameSWF.FH2F_cancelCashier();

}

function F2FH_closeCashierPopup()
{
    var gameSWF = getGPELauncher();
    gameSWF.FH2F_closeCashierPopup();
}

function F2FH_requestAvailableBalance()
{
    var gameSWF = getGPELauncher();
    gameSWF.FH2F_requestAvailableBalance();
}

function F2FH_requestPassthrough(params)
{
    var gameSWF = getGPELauncher();
    gameSWF.FH2F_requestPassthrough(params);
}

/*******************************************************************************
 * These calls are made from the CashierView
 * The flow is Cashier View --> Flash Host --> Cashier
 *******************************************************************************/

function F2FH_returnAvailableBalance(amount,freePlayBalance)
{
    var gameSWF = getGPELauncher();
    if(freePlayBalance == null)
    {
       gameSWF.FH2F_returnAvailableBalance(amount);
    }
    else
    {
       gameSWF.FH2F_returnAvailableBalance(amount,freePlayBalance);  
    }
}

function F2FH_cashierTransactionComplete(amount)
{
    var gameSWF = getGPELauncher();
    gameSWF.FH2F_cashierTransactionComplete(amount);
}

function F2FH_cashierException()
{
    var gameSWF = getGPELauncher();
    gameSWF.FH2F_cashierException();
}


/***********
 * For Barcrest Game
 *
 ************/
 function F2FH_updateFGAPBalance(balance)
 {
    var gameSWF = getGPELauncher();
    gameSWF.FH2F_updateFGAPBalance(balance);
 }
 
 function F2FH_cancelFGAPCashier()
 {
     var gameSWF = getGPELauncher();
     gameSWF.FH2F_cancelFGAPCashier();
 }
