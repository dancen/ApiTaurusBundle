<?php

namespace Api\TaurusBundle;

/**
 * Api\TaurusBundle\ApiTBLEvents
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */

final class ApiTaurusEvents
{
       
    
    /**
     * The INIT_TRANSACTION event occurs when the user send the secret code.
     */
    const INIT_TRANSACTION = 'init.transaction';
    
     /**
     * The SEND_AUTHORIZATION_CODE event occurs when the system send the authorization code to the user's smartphone.
     */
    const SEND_AUTHORIZATION_CODE = 'send.auhorizationcode';
    
     /**
     * The CHECK_AUTHORIZATION_CODE event occurs when the user digit the authorization code.
     */
    const CHECK_AUTHORIZATION_CODE = 'check.auhorizationcode';
    
     /**
     * The EXECUTE_TRANSACTION event occurs when the user post bank trasaction data.
     */
    const EXECUTE_TRANSACTION = 'execute.transaction';
    
     /**
     * The SEND_OPERATION_CODE event occurs when the system send the operation code.
     */
    const SEND_OPERATION_CODE = 'send.operationcode';    
    
     /**
     * The SAVE_TRANSACTION event occurs when the system save the transaction to database.
     */
    const SAVE_TRANSACTION = 'save.transaction';
    
     /**
     * The CANCEL_TRANSACTION event occurs when the admin delete the transaction from the database.
     */
    const CANCEL_TRANSACTION = 'cancel.transaction';
    
}