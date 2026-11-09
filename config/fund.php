<?php

return [

    /*
    | Cash aid released for every claim that reaches the "Disbursed" status
    | (one claim per deceased member). Used by the mobile dashboard to turn
    | the number of disbursed claims into pesos.
    */
    'cash_aid_per_claim' => (float) env('FUND_CASH_AID_PER_CLAIM', 12500),

    /*
    | Timezone used to decide what "this month" means on the dashboard.
    | Database timestamps stay in app.timezone.
    */
    'timezone' => env('FUND_TIMEZONE', 'Asia/Manila'),

];
