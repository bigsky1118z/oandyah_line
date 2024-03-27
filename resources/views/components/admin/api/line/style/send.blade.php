<style>
    /* SEND */
    /* MODAL TYPE MESSAGE */
        .modal-message {
            z-index: 7777;
            background-color: rgba(0,0,0,0.5);
        }
        .modal-message-content {
            background-color: #fff;
            width: 500px;
            max-height: 650px;
            overflow-y: auto;
            margin: 50px auto 25px auto;
            padding: 20px;
        }    
        .modal-message-content input {
            width: 420px;
        }
        .modal-message-content input[type=radio] {
            width: unset;
        }

        .modal-message-content textarea{
            resize: none;
            width: 420px;
        }
        
    /* MODAL TYPE COLUMN */
        .modal-column {
            z-index: 8888;
            background-color: rgba(0,0,0,0.5);
        }
        .modal-column-content {
            background-color: #FFFFFF;
            width: 450px;
            max-height: 600px;
            overflow-y: auto;
            margin: 75px auto 35px auto;
            padding: 20px;
        }
        .modal-column-content input {
            width: 300px;
        } 

        .modal-column-content input[type=radio] {
            width: unset;
        }

        .modal-column-content textarea{
            resize: none;
            width: 350px;
        }

        .modal-column-content .content-dd {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    
    /* MODAL TYPE ACTION */
        .modal-action {
            z-index: 9999;
            background-color: rgba(0,0,0,0.5);
        }
        .modal-action-content {
            background-color: #FFFFFF;
            width: 400px;
            max-height: 500px;
            overflow-y: auto;
            margin: 100px auto 50px auto;
            padding: 20px;
        }
        .modal-action-content input,
        {
            width: 220px
        }
        .modal-action-content input[type=radio] {
            width: unset;
        }
        .modal-action-content textarea {        
            resize: none;
            width: 280px;
        }



    /* MODAL TYPE OPTION */
        .modal-option {
            z-index: 7777;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-option-content {
            background-color: #fff;
            width: 500px;
            max-height: 700px;
            overflow-y: auto;
            margin: 50px auto 25px auto;
            padding: 20px;
        }



    .modal-message-content .content-dd {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
        

    .modal-message-content .display-column {
        display: flex;
        max-width: 420px;
        overflow-x: auto;
        margin: 0 auto;
    }

    .modal-message-content .display-column dl {
        min-width: 200px;
    }
    .content-dd img {
        max-width: 100px;
        max-height: 100px;
    }

</style>
