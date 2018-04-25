<style>
    html, body {
        font-family: 'Roboto', 'Helvetica', sans-serif;
    }

    a:hover {
        text-decoration: none;
    }

    .mari-navbar{
        background-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
    }

    .main-content .mdl-card__supporting-text {
        width: 100%;
        padding: 16px;
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

    .dash-side-tablets{
        width: 100%;
        height: 160px;
        margin-bottom: 35px;
        border-radius: 20px;
        padding: 12px 25px;
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

    [v-cloak] > * { display:none }
    [v-cloak]::before { content: "loading…" }

    .demo-avatar {
        width: 48px;
        height: 48px;
        border-radius: 24px;
    }
    .demo-layout .mdl-layout__header .mdl-layout__drawer-button {
        color: rgba(0, 0, 0, 0.54);
    }
    .mdl-layout__drawer .avatar {
        margin-bottom: 16px;
    }
    .demo-drawer {
        border: none;
    }
    /* iOS Safari specific workaround */
    .demo-drawer .mdl-menu__container {
        z-index: -1;
    }
    .demo-drawer .demo-navigation {
        z-index: -2;
    }
    /* END iOS Safari specific workaround */
    .demo-drawer .mdl-menu .mdl-menu__item {
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
    }
    .demo-drawer-header {
        box-sizing: border-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-justify-content: flex-end;
        -ms-flex-pack: end;
        justify-content: flex-end;
        padding: 16px;
        height: 151px;
    }
    .demo-avatar-dropdown {
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        position: relative;
        -webkit-flex-direction: row;
        -ms-flex-direction: row;
        flex-direction: row;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        width: 100%;
    }

    .demo-navigation {
        -webkit-flex-grow: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
    }
    .demo-layout .demo-navigation .mdl-navigation__link {
        display: -webkit-flex !important;
        display: -ms-flexbox !important;
        display: flex !important;
        -webkit-flex-direction: row;
        -ms-flex-direction: row;
        flex-direction: row;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        color: rgba(255, 255, 255, 0.56);
        font-weight: 500;
    }
    .demo-layout .demo-navigation .mdl-navigation__link:hover {
        background-color: #00BCD4;
        color: #37474F;
    }
    .demo-navigation .mdl-navigation__link .material-icons {
        font-size: 24px;
        color: rgba(255, 255, 255, 0.56);
        margin-right: 32px;
    }

    .demo-content {
        /*max-width: 1080px;*/
    }

    .demo-charts {
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
    }
    .demo-chart:nth-child(1) {
        color: #ACEC00;
    }
    .demo-chart:nth-child(2) {
        color: #00BBD6;
    }
    .demo-chart:nth-child(3) {
        color: #BA65C9;
    }
    .demo-chart:nth-child(4) {
        color: #EF3C79;
    }
    .demo-graphs {
        padding: 16px 32px;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-align-items: stretch;
        -ms-flex-align: stretch;
        align-items: stretch;
    }
    /* TODO: Find a proper solution to have the graphs
     * not float around outside their container in IE10/11.
     * Using a browserhacks.com solution for now.
     */
    _:-ms-input-placeholder, :root .demo-graphs {
        min-height: 664px;
    }
    _:-ms-input-placeholder, :root .demo-graph {
        max-height: 300px;
    }
    /* TODO end */
    .demo-graph:nth-child(1) {
        color: #00b9d8;
    }
    .demo-graph:nth-child(2) {
        color: #d9006e;
    }

    .demo-cards {
        -webkit-align-items: flex-start;
        -ms-flex-align: start;
        align-items: flex-start;
        -webkit-align-content: flex-start;
        -ms-flex-line-pack: start;
        align-content: flex-start;
    }
    .demo-cards .demo-separator {
        height: 32px;
    }
    .demo-cards .mdl-card__title.mdl-card__title {
        color: white;
        font-size: 24px;
        font-weight: 400;
    }
    .demo-cards ul {
        padding: 0;
    }
    .demo-cards h3 {
        font-size: 1em;
    }
    .demo-updates .mdl-card__title {
        min-height: 200px;
        background-image: url('images/dog.png');
        background-position: 90% 100%;
        background-repeat: no-repeat;
    }
    .demo-cards .mdl-card__actions a {
        color: #00BCD4;
        text-decoration: none;
    }

    .demo-options h3 {
        margin: 0;
    }
    .demo-options .mdl-checkbox__box-outline {
        border-color: rgba(255, 255, 255, 0.89);
    }
    .demo-options ul {
        margin: 0;
        list-style-type: none;
    }
    .demo-options li {
        margin: 4px 0;
    }
    .demo-options .material-icons {
        color: rgba(255, 255, 255, 0.89);
    }
    .demo-options .mdl-card__actions {
        height: 64px;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        box-sizing: border-box;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
    }
    .mdl-components__warning {
        background-color: #FFF9C4;
    }
    .mdl-components__success {
        background-color: #8bc34a;
        color: white;
    }
    .mdl-components__danger {
        background-color: #e94136;
        color: white;
    }
    .mdl-components__default {
        background-color: #d8d8d8;
    }
    .mdl-components__info {
        background-color: rgb(3, 169, 244);
        color: white;
    }
    .mdl-layout__drawer .mdl-navigation .mdl-navigation__link {
        padding: 10px 40px;
    }
    [data-scrollbar] {
        position: fixed !important;
    }
    .help-block code {
        float:right;
    }
</style>