<style>
    .message-object {
        display: flex;
        flex-direction: column;
        max-width: 310px;
    }
    /* .message-object>dd {
        max-width: 310px;
    } */

    .message-object.text{
        flex-direction: row;
        flex-wrap: wrap;
    }
    .message-object.text dd.text{
        background-color: #4CC764;
        flex-wrap: wrap;
        padding: 5px 15px;
        border-radius: 30px;
    }
    
    .message-object.image{
        flex-direction: row;
        flex-wrap: wrap;
    }
    .message-object.image>dd{
        margin-right: 10px;
    }
    .message-object.image>dd:last-child{
        margin-right: unset;
    }
    .message-object.image dt{
        text-align: center;
    }
    .message-object.image img{
        border-radius: 5px;
        width: 150px;
        height: auto;
    }
    .message-object.location {
        background-color: #4CC764;
        border-radius: 5px;
        padding: 10px;
    }
    .message-object.location .latitude,
    .message-object.location .longitude,
    .message-object.location .map {
        margin: 0;
        background-color: rgba(255, 255, 255, 0.8);
        text-align: center;
    }

    .message-object.template>dd{
        margin-bottom: 10px;
    }
    .message-object.template>dd:last-child{
        margin-bottom: unset;
    }


    .message-object.template .alt_text{
        background-color: #4CC764;
        border-radius: 5px;
        padding: 5px 15px;
    }
    .message-object.template .template-buttons,
    .message-object.template .template-confirm {
        border: 1px solid #000000;
        border-radius: 5px;
    }
    .message-object.template .template-buttons .template-title,
    .message-object.template .template-buttons .template-text-only {
        background-color: #AAAAAA;
        border-radius: 5px 5px 0 0;
        padding: 5px 15px;
    }
    .message-object.template .template-buttons .template-title{
        font-weight: bold;
    }
    .message-object.template .template-buttons .template-text {
        background-color: #AAAAAA;
        padding: 5px 15px;
    }
    .message-object.template .template-buttons .template-actions {
        background-color: #EEEEEE;
        border-radius: 0 0 5px 5px;
        padding: 5px 15px;
    }
    .message-object.template .template-buttons .template-actions dl{
        display: flex;
        flex-direction: column;
    }
    .message-object.template .template-confirm .template-actions .template-actions-label{
        text-align: left;
    }



    .message-object.template .template-confirm .template-text {
        background-color: #AAAAAA;
        border-radius: 5px 5px 0 0;
        padding: 5px 15px;
    }
    .message-object.template .template-confirm .template-actions {
        background-color: #EEEEEE;
        border-radius: 0 0 5px 5px;
        padding: 5px 15px;
    }

    .message-object.template .template-confirm .template-actions dl{
        display: flex;
        flex-direction: row;
        justify-content: center;
        width: 100%;
    }
    .message-object.template .template-confirm .template-actions .template-actions-label{
        border-right: 1px solid #000000;
        text-align: center;
        width: 50%;
    }
    .message-object.template .template-confirm .template-actions .template-actions-label:last-child{
        border-right: 0;
    }



</style>