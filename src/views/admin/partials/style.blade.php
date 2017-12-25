<style>
    @font-face {
        font-family: 'product_sansbold';
        src: url('../fonts/product_sans_bold-webfont.woff2') format('woff2'),
        url('../fonts/product_sans_bold-webfont.woff') format('woff');
        font-weight: normal;
        font-style: normal;
    }

    @font-face {
        font-family: 'product_sansregular';
        src: url('../fonts/product_sans_regular-webfont.woff2') format('woff2'),
        url('../fonts/product_sans_regular-webfont.woff') format('woff');
        font-weight: normal;
        font-style: normal;
    }

    body{
        font-family: 'product_sansregular';
        padding-top: 120px;


    }
    /*-----------------------------ADMIN DASHBOARD PAGE HERE------------------------------*/
    .well{
        color: #4E4E4E;
    }
    .table-shadow{
        box-shadow: 0 1px 3px rgba(0,0,0,0.12);
    }
    .rounded-border-well{
        border-radius: 20px;
        margin-bottom: 50px;
    }
    .rounded-border-btn{
        border-radius: 20px;
        padding: 10px 30px;
        color: #4E4E4E;
    }
    .dashboard-welcome{
        background: #fff;
    }
    .dashboard-welcome .rounded-border-btn{
        margin: auto 10px;
    }
    .shadow-effect{
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .well-home{
        background: #fff;
    }
    .well-home h3{
        margin-bottom: 20px;
    }

    table{
        width:100%;
    }
    table td{
        white-space: no-wrap;
        word-break: break-all;
    }
    table th{
        font-weight: 600;
        font-size: 1.4em;
    }
    .fix-action-width{
        width: 50%;
    }
    .table>thead>tr>th{
        padding-bottom: 20px;
    }
    .fix-margin-bottom{
        margin-bottom: 50px;
    }
    .margin-top-2{
        margin: 40px auto;

    }
    .panel-heading{
        font-size: 20px !important;
        font-weight: bold;
        margin-bottom: 40px;
        background-color: #fff !important;
        border-color: #fff !important;

    }
    .margin-top-2 .panel-default{
        border: none;
    }
    .margin-top-2 .panel-footer{
        display: none;
    }

    .margin-top-2 .panel{
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0);
    }
    .dashboard-welcome-greeting{
        margin-bottom: 20px;
    }
    .dash-side-tablets{
        width: 100%;
        height: 160px;
        margin-bottom: 35px;
        border-radius: 20px;
    }
    .dash-side-tablets-1{
        background-image: linear-gradient(to right, #d4fc79 , #96e6a1 );
    }

    .dash-side-tablets-2{
        background-image: linear-gradient(to left, #a1c4fd , #c2e9fb );
    }

    .dash-side-tablets-3{
        background-image: linear-gradient(to right, #89f7fe , #66a6ff );
    }
    .dash-side-tablets h3{
        font-family: product_sansbold !Important;
        color: #ffffff;
        font-size: 25px;
        line-height: 1;
    }
    .dash-side-tablets h4{
        font-family: product_sansbold !Important;
        color: #ffffff;
        font-size: 40px;
        line-height: 1;
    }
    /*-----------------------------ADMIN DASHBOARD PAGE ENDS HERE------------------------------*/
    .form-signin-heading{
        width:200px;
        height:150px;
        margin-bottom: 10px !important;
        margin:0 auto;
    }

    .form-signin-heading img{
        width: 100%;
        height: 150px;
        object-fit: contain;
        object-position: center;
    }

    .footer-link{
        font-size: 12px;
    }
    .mari-navbar{
        background-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 0px;
        border: none;
        color: #fff;
        margin-bottom: 50px;
        min-height:80px;
        position: fixed;

    }

    .navbar-brand{
        font-family: 'product_sansbold';
        color: #fff !important;
        line-height: 50px;
        margin-left: 15px !important;
        font-size: 20px;
    }
    .navbar-brand img{
        float: right;
        width: 100px;
        height: 50px;
        object-fit: contain;
        object-position: center;
    }
    .navbar-default .navbar-nav>li>a{
        color: #fff;
    }
    .mari-navbar-top{
        margin-top: 10px;
    }

    .mar-nav{
        background-image: linear-gradient(135deg, #000000 0%, #0f0f0f 100%);
        height: 100vh;
        box-shadow: 0 2px 10px 0 rgba(0,0,0,0.16);
        overflow-y: scroll;
    }
    .mar-nav a{
        color: #fff;
        padding: 20px !important;
    }
    .mar-nav li a:hover{
        background: #0f0f0f;
    }
    .mar-nav a i{
        font-size: 1.5em;
        height: 20px;
        width: 20px;
        margin-right: 20px;
    }
    .default-card-wide{
        width: 100%;
    }
    .pull-right{
        float: right;
    }
    .page-title-first{
        color: grey;
    }
    .dash-side-tablets{
        padding: 10px 20px;

    }
    .mdl-button {
        margin-right: 10px;
    }
    .update-button{
        margin-top: 80px;
    }
    .text-success{
        color: #96e31a;
        text-align: center;
    }
    .mdl-card{
        z-index: 0 !important;
    }
    .main-menu-mari{
        width: 15%;
        position: fixed;
        top: 80px;
    }
    .mdl-card__supporting-text{
        width: 100%;
    }
    .mdl-layout__obfuscator.is-visible{
        top: 80px;
        position: fixed;
    }
    .mdl-layout__drawer .mdl-navigation{
        top: 80px;
        position: relative;
        padding-top: 0px;
    }
    .mdl-layout__drawer{
        background: transparent;
        border: none;
        box-shadow: none;
        position: fixed;
        z-index: 1;
        overflow: hidden;
    }
    .mdl-layout__drawer .mdl-navigation .mdl-navigation__link{
        color: #fff;
    }
    .mdl-navigation__link:hover{
        background:#667eea !important;
    }
    .mdl-layout__drawer-button{
        z-index: 999999999999;
        color: #fff;
        line-height: 70px;
        position: fixed;
    }
    .mdl-navigation{
        box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12)
    }
    .mdl-layout__content{
        z-index: 0 !important;
    }



    /*gallery*/
    .gallery-card-image .mdl-card__title{
        padding: 0px !important;
        width: 100%;
        position: absolute;
    }
    .gallery-card-image{
        width:100%;
        position: relative;
    }
    .gallery-card-image .mdl-card__actions{
        position: absolute;
        z-index: 1;
        bottom: 0;
    }
    .gallery-image-checkbox label{
        width: 100%;
    }

    .gallery-card-image img{
        width: 100%;
        height: 200px;
        object-position: center;
        object-fit: contain;
    }
    .gallery-card-image > .mdl-card__actions {
        height: 70px;
        padding: 16px;
        background: rgba(0, 0, 0, 0.6);
    }
    .gallery-card-image__filename {
        color: #fff;
        font-size: 14px;
        font-weight: 500;
    }
    .gallery-image-checkbox input[type=checkbox]{
        display: none;
    }
    .gallery-image-checkbox input[type=checkbox]:checked + label::before{
        content: '\f00c';
        font-family: FontAwesome;
        color: #00B16A;
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        margin: 10px 0px;
        right: 5px;
        top: -20px;
        background: #ffffff;
        border-radius: 50%;
        box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
        position: absolute;
        z-index: 2;

    }

    .featherwebs-mari-footer{
        padding: 0 20px;
        color: grey;
        /*position: absolute !important;*/
        /*bottom: 10%;*/
    }
    /*.featherwebs-mari-footer a{*/
        /*padding: 0 !important;*/
        /*display: inline !important;*/

    /*}*/
    /*==========  Non-Mobile First Method  ==========*/

    /* Large Devices, Wide Screens */
    @media only screen and (max-width : 1200px) {


    }

    /* Medium Devices, Desktops */
    @media only screen and (max-width : 992px) {

    }

    /* Small Devices, Tablets */
    @media only screen and (max-width : 768px) {
        .navbar-brand{
            max-width: 370px;
        }
    }

    /* Extra Small Devices, Phones */
    @media only screen and (max-width : 480px) {
        .navbar-brand {
            margin-left: 80px !important;
            text-align: center;
        }
    }

    /* Custom, iPhone Retina */
    @media only screen and (max-width : 320px) {

    }

</style>