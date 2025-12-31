<?php 
include 'admin/db_connect.php'; 
session_start(); // Ensure session is started to access user details
?>
<style>
/* ... existing CSS code ... */
</style>
<header class="masthead">
    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <h3 class="text-white">Job List</h3>
                <hr class="divider my-4" />
                <div class="row col-md-12 mb-2 justify-content-center">
                    <?php if(isset($_SESSION['login_type']) && $_SESSION['login_type'] == 3): // Check if logged-in user is an alumni ?>
                        <button class="btn btn-primary btn-block col-sm-4" type="button" id="new_career">
                            <i class="fa fa-plus"></i> Post a Job Opportunity
                        </button>
                    <?php endif; ?>
                </div>   
            </div>
        </div>
    </div>
</header>
<div class="container mt-3 pt-2">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="filter-field"><i class="fa fa-search"></i></span>
                      </div>
                      <input type="text" class="form-control" placeholder="Filter" id="filter" aria-label="Filter" aria-describedby="filter-field">
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary btn-block btn-sm" id="search">Search</button>
                </div>
            </div>
        </div>
    </div>
   <?php
    $event = $conn->query("SELECT c.*,u.name from careers c inner join users u on u.id = c.user_id order by id desc");
    while($row = $event->fetch_assoc()):
        $trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
        $desc = strtr(html_entity_decode($row['description']),$trans);
        $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
    ?>
    <div class="card job-list" data-id="<?php echo $row['id'] ?>">
        <div class="card-body">
            <div class="row  align-items-center justify-content-center text-center h-100">
                <div class="">
                    <h3><b class="filter-txt"><?php echo ucwords($row['job_title']) ?></b></h3>
                    <div>
                    <span class="filter-txt"><small><b><i class="fa fa-building"></i> <?php echo ucwords($row['company']) ?></b></small></span>
                    <span class="filter-txt"><small><b><i class="fa fa-map-marker"></i> <?php echo ucwords($row['location']) ?></b></small></span>
                    </div>
                    <hr>
                    <larger class="truncate filter-txt"><?php echo strip_tags($desc) ?></larger>
                    <br>
                    <?php if (!empty($row['link'])): ?>
                        <hr>
                        <p><b>Job Link:</b> <a href="<?php echo $row['link'] ?>" target="_blank"><?php echo $row['link'] ?></a></p>
                    <?php endif; ?>
                    <hr class="divider"  style="max-width: calc(80%)">
                    <span class="badge badge-info float-left px-3 pt-1 pb-1">
                        <b><i>Posted by: <?php echo $row['name'] ?></i></b>
                    </span>
                    <button class="btn btn-primary float-right read_more" data-id="<?php echo $row['id'] ?>">Read More</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <?php endwhile; ?>
</div>

<script>
    $('#new_career').click(function(){
        uni_modal("New Job Hiring", "manage_career.php", 'mid-large')
    });
    $('.read_more').click(function(){
        uni_modal("Career Opportunity", "view_jobs.php?id=" + $(this).attr('data-id'), 'mid-large')
    });
    $('#filter').keypress(function(e){
        if(e.which == 13)
            $('#search').trigger('click')
    });
    $('#search').click(function(){
        var txt = $('#filter').val()
        start_load()
        if(txt == ''){
            $('.job-list').show()
            end_load()
            return false;
        }
        $('.job-list').each(function(){
            var content = "";
            $(this).find(".filter-txt").each(function(){
                content += ' ' + $(this).text()
            });
            if((content.toLowerCase()).includes(txt.toLowerCase()) == true){
                $(this).toggle(true)
            } else {
                $(this).toggle(false)
            }
        });
        end_load()
    });
</script>
