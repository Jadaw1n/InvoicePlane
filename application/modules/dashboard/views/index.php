<div class="headerbar">
    <h1><?php echo lang('dashboard'); ?></h1>
</div>

<?php echo $this->layout->load_view('layout/alerts'); ?>

<div class="content">
    <div class="row">
    <div class="col-xs-12 col-md-6">

        <div class="panel panel-default quick-actions">

            <div class="panel-heading">
                <h3 class="panel-title"><?php echo lang('quick_actions'); ?></h3>
            </div>

            <div class="panel-body">

                <div class="btn-group btn-group-justified">
                    <a href="<?php echo site_url('clients/form'); ?>"
                       class="btn btn-default">
                        <i class="fa fa-user"></i>&nbsp;
                        <span class="hidden-md hidden-xs">
                            <?php echo lang('add_client'); ?>
                        </span>
                    </a>
                    <a href="javascript:void(0)" class="create-quote btn btn-default">
                        <i class="fa fa-file"></i>&nbsp;
                        <span class="hidden-md hidden-xs">
                            <?php echo lang('create_quote'); ?>
                        </span>
                    </a>
                    <a href="javascript:void(0)" class="create-invoice btn btn-default">
                        <i class="fa fa-file-text"></i>&nbsp;
                        <span class="hidden-md hidden-xs">
                            <?php echo lang('create_invoice'); ?>
                        </span>
                    </a>
                    <a href="<?php echo site_url('payments/form'); ?>"
                       class="btn btn-default">
                        <i class="fa fa-money"></i>&nbsp;
                        <span class="hidden-md hidden-xs">
                            <?php echo lang('enter_payment'); ?>
                        </span>
                    </a>
                </div>

            </div>

        </div>

        <div class="panel panel-default overview">

            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-file"></i>
                    <?php echo lang('quote_overview'); ?>
                </h3>
            </div>

            <div class="panel-body">

                <?php foreach ($quote_status_totals as $total) { ?>
                    <div class="col-xs-6 col-sm-4 col-lg-2">
                        <a href="<?php echo site_url($total['href']); ?>">
                            <?php echo $total['label']; ?>
                        </a>
                        <br/>
                        <span class="<?php echo $total['class']; ?>">
                            <?php echo format_currency($total['sum_total']); ?>
                        </span>
                        <span class="hidden-lg"><hr/></span>
                    </div>
                <?php } ?>

            </div>

        </div>

        <div class="panel panel-default overview">

            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-file-text"></i>
                    <?php echo lang('invoice_overview'); ?>
                </h3>
            </div>

            <div class="panel-body">

                <?php foreach ($invoice_status_totals as $total) { ?>
                    <div class="col-xs-6 col-sm-4 col-lg-2">
                        <a href="<?php echo site_url($total['href']); ?>">
                            <?php echo $total['label']; ?>
                        </a>
                        <br/>
                        <span class="<?php echo $total['class']; ?>">
                            <?php echo format_currency($total['sum_total']); ?>
                        </span>
                        <span class="hidden-lg"><hr/></span>
                    </div>
                <?php } ?>

            </div>
        </div>

    </div>

    <div class="col-xs-12 col-md-6">

        <div class="panel panel-default">

            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-warning"></i>
                    <?php echo lang('overdue_invoices'); ?>
                </h3>
            </div>

            <div class="panel-body">

                <?php if ( !empty($overdue_invoices) ) { ?>

                    <div class="table-responsive">
                    <table class="table table-striped no-margin">
                        <thead>
                        <tr>
                            <th style="width: 15%;"><?php echo lang('status'); ?></th>
                            <th style="width: 15%;"><?php echo lang('due_date'); ?></th>
                            <th style="width: 10%;"><?php echo lang('invoice'); ?></th>
                            <th style="width: 40%;"><?php echo lang('client'); ?></th>
                            <th style="text-align: right; width: 15%;"><?php echo lang('balance'); ?></th>
                            <th style="text-align: center; width: 5%;"><?php echo lang('pdf'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($overdue_invoices as $invoice) { ?>
                            <tr>
                                <td>
                                    <span class="label
                                    <?php echo $invoice_statuses[$invoice->invoice_status_id]['class']; ?>">
                                        <?php echo $invoice_statuses[$invoice->invoice_status_id]['label']; ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="font-overdue">
                                        <?php echo date_from_mysql($invoice->invoice_date_due); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php echo anchor('invoices/view/' . $invoice->invoice_id, $invoice->invoice_number); ?>
                                </td>
                                <td>
                                    <?php echo anchor('clients/view/' . $invoice->client_id, $invoice->client_name); ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php echo format_currency($invoice->invoice_balance); ?>
                                </td>
                                <td style="text-align: center;">
                                    <a href="<?php echo site_url('invoices/generate_pdf/' . $invoice->invoice_id); ?>"
                                       title="<?php echo lang('download_pdf'); ?>">
                                        <i class="icon ion-printer"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">
                                <?php echo anchor('invoices/status/overdue', lang('view_all')); ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    </div>

                <?php } else { ?>

                    <span class="text-success"><?php echo lang('no_overdue_invoices'); ?></span>

                <?php } ?>

            </div>
        </div>

        <div class="panel panel-default">

            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-refresh"></i>
                    <?php echo lang('recent_quotes'); ?>
                </h3>
            </div>
            <div class="panel-body">

                <div class="table-responsive">
                <table class="table table-striped no-margin">
                    <thead>
                    <tr>
                        <th style="width: 15%;"><?php echo lang('status'); ?></th>
                        <th style="width: 15%;"><?php echo lang('date'); ?></th>
                        <th style="width: 10%;"><?php echo lang('quote'); ?></th>
                        <th style="width: 40%;"><?php echo lang('client'); ?></th>
                        <th style="text-align: right; width: 15%;"><?php echo lang('balance'); ?></th>
                        <th style="text-align: center; width: 5%;"><?php echo lang('pdf'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($quotes as $quote) { ?>
                        <tr>
                            <td>
                                <span class="label
                                <?php echo $quote_statuses[$quote->quote_status_id]['class']; ?>">
                                    <?php echo $quote_statuses[$quote->quote_status_id]['label']; ?>
                                </span>
                            </td>
                            <td>
                                <?php echo date_from_mysql($quote->quote_date_created); ?>
                            </td>
                            <td>
                                <?php echo anchor('quotes/view/' . $quote->quote_id, $quote->quote_number); ?>
                            </td>
                            <td>
                                <?php echo anchor('clients/view/' . $quote->client_id, $quote->client_name); ?>
                            </td>
                            <td style="text-align: right;">
                                <?php echo format_currency($quote->quote_total); ?>
                            </td>
                            <td style="text-align: center;">
                                <a href="<?php echo site_url('quotes/generate_pdf/' . $quote->quote_id); ?>"
                                   title="<?php echo lang('download_pdf'); ?>">
                                    <i class="fa fa-print"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">
                            <?php echo anchor('quotes/status/all', lang('view_all')); ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </div>

            </div>
        </div>

        <div class="panel panel-default">

            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-refresh"></i>
                    <?php echo lang('recent_invoices'); ?></h3>
            </div>

            <div class="panel-body">

                <div class="table-responsive">
                <table class="table table-striped no-margin">
                    <thead>
                    <tr>
                        <th style="width: 15%;"><?php echo lang('status'); ?></th>
                        <th style="width: 15%;"><?php echo lang('due_date'); ?></th>
                        <th style="width: 10%;"><?php echo lang('invoice'); ?></th>
                        <th style="width: 40%;"><?php echo lang('client'); ?></th>
                        <th style="text-align: right; width: 15%;"><?php echo lang('balance'); ?></th>
                        <th style="text-align: center; width: 5%;"><?php echo lang('pdf'); ?></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($invoices as $invoice) { ?>
                        <tr>
                            <td>
                                <span class="label
                                <?php echo $invoice_statuses[$invoice->invoice_status_id]['class']; ?>">
                                    <?php echo $invoice_statuses[$invoice->invoice_status_id]['label']; ?>
                                </span>
                            </td>
                            <td>
                                <span class="<?php if ($invoice->is_overdue) { ?>font-overdue<?php } ?>">
                                    <?php echo date_from_mysql($invoice->invoice_date_due); ?>
                                </span>
                            </td>
                            <td>
                                <?php echo anchor('invoices/view/' . $invoice->invoice_id, $invoice->invoice_number); ?>
                            </td>
                            <td>
                                <?php echo anchor('clients/view/' . $invoice->client_id, $invoice->client_name); ?>
                            </td>
                            <td style="text-align: right;">
                                <?php echo format_currency($invoice->invoice_balance); ?>
                            </td>
                            <td style="text-align: center;">
                                <a href="<?php echo site_url('invoices/generate_pdf/' . $invoice->invoice_id); ?>"
                                   title="<?php echo lang('download_pdf'); ?>">
                                    <i class="fa fa-print"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>

                    <tr>
                        <td colspan="6" style="text-align: center;">
                            <?php echo anchor('invoices/status/all', lang('view_all')); ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </div>

            </div>
        </div>

    </div><!-- /.col-xs-12 col-md-6 -->
    </div><!-- /.row -->
</div><!-- /.content -->