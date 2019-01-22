<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script src="<?php echo base_url('public/scripts/charts.js'); ?>"></script>

<div class="columns is-mobile is-multiline">
    <div class="column is-half-tablet is-one-quarter-desktop">
        <div class="box notification is-info">
            <div class="heading">Projects Summary</div>
            <div class="title"><?php echo $projects_count; ?></div>
            <div class="level is-mobile">
                <div class="level-item">
                    <div>
                        <div class="heading">Incomplete</div>
                        <div class="title is-5"><?php echo $projects_incomplete_count; ?></div>
                    </div>
                </div>
                <div class="level-item">
                    <div>
                        <div class="heading">Complete</div>
                        <div class="title is-5"><?php echo $projects_complete_count; ?></div>
                    </div>
                </div>
                <div class="level-item">
                    <div>
                        <div class="heading">Archived</div>
                        <div class="title is-5"><?php echo $projects_archived_count; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="column is-half-tablet is-one-quarter-desktop">
        <div class="box notification is-warning has-text-dark">
            <div class="heading">Customer Summary</div>
            <div class="title"><?php echo $customers_count; ?></div>
            <div class="level is-mobile">
                <div class="level-item">
                    <div>
                        <div class="heading">Prospects</div>
                        <div class="title is-5"><?php echo $customers_prospect_count; ?></div>
                    </div>
                </div>
                <div class="level-item">
                    <div>
                        <div class="heading">Pending</div>
                        <div class="title is-5"><?php echo $customers_pending_count; ?></div>
                    </div>
                </div>
                <div class="level-item">
                    <div>
                        <div class="heading">Live</div>
                        <div class="title is-5"><?php echo $customers_live_count; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="column is-half-tablet is-one-quarter-desktop">
        <div class="box notification is-danger">
            <div class="heading">Support Summary</div>
            <div class="title"><?php echo $support_count; ?></div>
            <div class="level is-mobile">
                <div class="level-item">
                    <div>
                        <div class="heading">Open</div>
                        <div class="title is-5"><?php echo $support_open_count; ?></div>
                    </div>
                </div>
                <div class="level-item">
                    <div>
                        <div class="heading">Closed</div>
                        <div class="title is-5"><?php echo $support_closed_count; ?></div>
                    </div>
                </div>
                <div class="level-item">
                    <div>
                        <div class="heading">Archived</div>
                        <div class="title is-5"><?php echo $support_archived_count; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="column is-half-tablet is-one-quarter-desktop">
        <div class="box notification is-success has-text-dark">
            <div class="heading">Completed (This Week)</div>
            <div class="title"><?php echo $completed_total; ?></div>
            <div class="level is-mobile">
                <div class="level-item">
                    <div>
                        <div class="heading">Projects</div>
                        <div class="title is-5"><?php echo $completed_projects; ?></div>
                    </div>
                </div>
                <div class="level-item">
                    <div>
                        <div class="heading">Support</div>
                        <div class="title is-5"><?php echo $completed_support; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="columns">
    <div class="column is-half">
        <canvas id="customerSupport"></canvas>
    </div>
    <div class="column is-half">
        <canvas id="versusProjectSupport"></canvas>
    </div>
</div>

<div class="columns">
    <div class="column is-half">
        <div class="panel">
            <div class="panel-heading has-background-success has-text-dark">
                <h2><i class="fas fa-project-diagram"></i> My Projects</h2>
            </div>
            <div class="panel-block">
                <?php $this->load->view('projects/projects_user'); ?>
            </div>
        </div>
    </div>
    <div class="column is-half">
        <div class="panel">
            <div class="panel-heading has-background-warning has-text-dark">
                <h2><i class="fas fa-bug"></i> My Support</h2>
            </div>
            <div class="panel-block">
                <?php $this->load->view('support/support_user'); ?>
            </div>
        </div>
    </div>
</div>

<div class="columns">
    <div class="column is-half">
        <div class="panel">
            <div class="panel-heading has-background-info has-text-white">
                <h2><i class="fas fa-project-diagram"></i> Incomplete Projects</h2>
            </div>
            <div class="panel-block">
                <?php $this->load->view('projects/projects_incomplete'); ?>
            </div>
        </div>
    </div>
    <div class="column is-half">
        <div class="panel">
            <div class="panel-heading has-background-danger has-text-white">
                <h2><i class="fas fa-bug"></i> Open Support</h2>
            </div>
            <div class="panel-block">
                <?php $this->load->view('support/support_open'); ?>
            </div>
        </div>
    </div>
</div>

<div class="columns">
    <div class="column is-half">
        <div class="panel">
            <div class="panel-heading has-background-primary has-text-dark">
                <h2><i class="fas fa-users"></i> My Customers</h2>
            </div>
            <div class="panel-block">
                <?php $this->load->view('sales/customers/customers_user'); ?>
            </div>
        </div>
    </div>
</div>