<div class="row">
                            <div class="col-md-6 col-xl-3">
                                <div class="card mb-3 widget-content bg-midnight-bloom">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Jumlah Murid</div>
                                            <div class="widget-subheading"><i class="fa fa-users"></i></div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo mysqli_num_rows(mysqli_query($con,"SELECT * from murid"));?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card mb-3 widget-content bg-arielle-smile">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Jumlah Pelatih</div>
                                            <div class="widget-subheading"><i class="fa fa-user-secret"></i></div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo mysqli_num_rows(mysqli_query($con,"SELECT * from pelatih"));?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card mb-3 widget-content bg-grow-early">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Latihan</div>
                                            <div class="widget-subheading"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo mysqli_num_rows(mysqli_query($con,"SELECT * from latihan"));?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card mb-3 widget-content bg-premium-dark">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Partisipasi</div>
                                            <div class="widget-subheading"><i class="fa fa-check"></i></div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo mysqli_num_rows(mysqli_query($con,"SELECT * from absen"));?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>