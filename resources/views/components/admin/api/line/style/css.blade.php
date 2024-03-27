<style>
    body {
        color: #000000;
        background-color: #FFFFFF;
    }
    textarea {
        resize: none;
    }
    ul {
        list-style: none !important;
    }

    ul, dl, dt, dd {
        margin: 0;
        padding: 0;
    }

    ol {
        margin: 0;
    }

    /* img {
        vertical-align: bottom;
    } */

    dl.dl-flex {
        display: flex;
        flex-wrap: wrap;
    }

    dl.dl-flex-center,
    dl.dl-flex-left
    {
        display: flex;
        flex-wrap: wrap;
    }

    dl.dl-flex-center {
        justify-content: center;
    }

    dl.dl-flex-left {
        justify-content: left;
    }

    dl.dl-flex-center-nowrap,
    dl.dl-flex-left-nowrap
    {
        display: flex;
        flex-wrap: nowrap;
    }

    dl.dl-flex-center-nowrap {
        justify-content: center;
    }

    dl.dl-flex-left-nowrap {
        justify-content: left;
    }

    dl.dl-flex-center dt,
    dl.dl-flex-center dd,
    dl.dl-flex-left dt,
    dl.dl-flex-left dd
    {
        margin-right: 10px;
    }
    dl.dl-flex-center dd:last-child,
    dl.dl-flex-left dd:last-child
    {
        margin-right: unset;
    }

    div.div-dl-dt-150px > dl > dt {
        width: 150px;
    }

    dl.dl-dt-120px > dt {
        width: 120px;
    }
    dl.dl-dt-150px > dt {
        width: 150px;
    }
    dl.dl-dt-180px > dt {
        width: 180px;
    }
    dl.dl-dt-200px > dt {
        width: 200px;
    }
    dl.dl-dt-250px > dt {
        width: 250px;
    }
    dl.dl-dt-300px > dt {
        width: 300px;
    }
    dl.dl-dt-350px > dt {
        width: 350px;
    }
    dl.dl-dt-400px > dt {
        width: 400px;
    }
    dl.dl-dd-120px > dd {
        width: 120px;
    }
    dl.dl-dd-right > dd {
        text-align: right;
    }

    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }


    .modal-content {
        text-align: center;
    }

    .notification-banner {
        position: fixed;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        width: 360px;
        height: auto;
        z-index: 9999;
        background-color: rgba(255,255,255,1);
        padding: 20px;
        border: 1px solid rgba(0,0,0,0.1);
        border-radius: 10px;
    }

    .now-edit::after {
        content: "編集中";
    }

    .hidden {
        display: none !important;
    }

    .button {
        color: #000000;
        text-decoration: none;
        text-shadow: none;

        background-color: #EFEFEF;
        border: 1px outset #000000;

        display: inline-block;
        text-align: center;
        margin: 0;
        padding: 1px 6px;
        text-indent: 0px;
        text-shadow: none;
    }

    .button:hover {
        cursor: pointer;
        background-color: #EEEEEE;
    }

</style>