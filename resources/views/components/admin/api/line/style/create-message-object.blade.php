<style>
    .create-message-objects {
        display: flex;
        flex-wrap: nowrap;
        width: 1200px;
    }

    .create-message-object-messages {
        width: 350px;
        background-color: rgba(255, 0, 0, 1);
        padding: 20px;
    }
    .create-message-object-input {
        width: 450px;
        background-color: rgba(0, 255, 0, 1);
        padding: 20px;
    }
    .create-message-object-action {
        width: 400px;
        background-color: rgba(0, 0, 255, 1);
        padding: 20px;
    }

    .create-message-objects dd.content-dd {
        display: none;
    }



    section.create-message-object-input dl {
        display: flex;
        flex-direction: column;
        width: 100%;
    }
    section.create-message-object-input dl dd{
        margin-left: 50px;
    }

    /* text */
    section.create-message-object-input.text dl.text dd textarea{
        background-color: #4CC764;
        flex-wrap: wrap;
        padding: 10px 10px;
        border-radius: 15px;
        width: 300 px;
    }

    /* image */
    section.create-message-object-input.image dl dd.image-dd img{
        border-radius: 5px;
        width: 150px;
        height: auto;
    }
    section.create-message-object-input.image dl button.unselect{
        width: 150px;
        height: 150px;
    }


    section.create-message-object-input .create-message-object.location {
        background-color: #4CC764;
        border-radius: 5px;
        padding: 10px;
    }
    section.create-message-object-input .create-message-object.location .latitude,
    section.create-message-object-input .create-message-object.location .longitude,
    section.create-message-object-input .create-message-object.location .map {
        margin: 0;
        background-color: rgba(255, 255, 255, 0.8);
        text-align: center;
    }

    section.create-message-object-input .create-message-object.template>dd{
        margin-bottom: 10px;
    }
    section.create-message-object-input .create-message-object.template>dd:last-child{
        margin-bottom: unset;
    }


    section.create-message-object-input .create-message-object.template .alt_text{
        background-color: #4CC764;
        border-radius: 5px;
        padding: 5px 15px;
    }
    section.create-message-object-input .create-message-object.template .template-buttons,
    section.create-message-object-input .create-message-object.template .template-confirm {
        border: 1px solid #000000;
        border-radius: 5px;
    }
    section.create-message-object-input .create-message-object.template .template-buttons .template-title,
    section.create-message-object-input .create-message-object.template .template-buttons .template-text-only {
        background-color: #AAAAAA;
        border-radius: 5px 5px 0 0;
        padding: 5px 15px;
    }
    section.create-message-object-input .create-message-object.template .template-buttons .template-title{
        font-weight: bold;
    }
    section.create-message-object-input .create-message-object.template .template-buttons .template-text {
        background-color: #AAAAAA;
        padding: 5px 15px;
    }
    section.create-message-object-input .create-message-object.template .template-buttons .template-actions {
        background-color: #EEEEEE;
        border-radius: 0 0 5px 5px;
        padding: 5px 15px;
    }
    section.create-message-object-input .create-message-object.template .template-buttons .template-actions dl{
        display: flex;
        flex-direction: column;
    }
    section.create-message-object-input .create-message-object.template .template-confirm .template-actions .template-actions-label{
        text-align: left;
    }



    section.create-message-object-input .create-message-object.template .template-confirm .template-text {
        background-color: #AAAAAA;
        border-radius: 5px 5px 0 0;
        padding: 5px 15px;
    }
    section.create-message-object-input .create-message-object.template .template-confirm .template-actions {
        background-color: #EEEEEE;
        border-radius: 0 0 5px 5px;
        padding: 5px 15px;
    }

    section.create-message-object-input .create-message-object.template .template-confirm .template-actions dl{
        display: flex;
        flex-direction: row;
        justify-content: center;
        width: 100%;
    }
    section.create-message-object-input .create-message-object.template .template-confirm .template-actions .template-actions-label{
        border-right: 1px solid #000000;
        text-align: center;
        width: 50%;
    }
    section.create-message-object-input .create-message-object.template .template-confirm .template-actions .template-actions-label:last-child{
        border-right: 0;
    }



</style>