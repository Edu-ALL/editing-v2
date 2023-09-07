<div class="card border-0">
    <div class="card-header p-3 d-flex justify-content-between align-items-center bg-secondary text-white">
        Deadline
        <i class="fa-regular fa-calendar-check"></i>
    </div>
    <div class="card-body p-3 text-dark">
        <div class="row" style="font-size: 14px;">
            <div class="col-md-7">
                <i class="fa-solid fa-calendar-day me-1 text-primary"></i> Essay Deadline:
            </div>
            <div class="col-md-5 text-md-end">
                {{ date('D, d M Y', strtotime($editors_deadline)) }}
            </div>
            <div class="col-md-7">
                <i class="fa-solid fa-calendar-check me-1 text-primary"></i>
                Application Deadline:
            </div>
            <div class="col-md-5 text-md-end">
                {{ date('D, d M Y', strtotime($essay->application_deadline)) }}
            </div>
        </div>
    </div>
</div>
