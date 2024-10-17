@extend('layouts.star');
@section('content')

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <h1 style="font-weight: bold; padding-left: 30px;">Pendaftaran Maklumat</h1>
                    </li>
                  </ul>
                  <div>
                    <div class="btn-wrapper">
                      <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
                      <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
                    </div>
                  </div>
                </div>
                <div class="tab-content tab-content-basic">

                  <!-- content table start here -->
                  <div class="card card-rounded">
                    <div class="card-body">

                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="fullNameInput">Full Name</label>
                                <input type="text" class="form-control" id="fullNameInput" placeholder="Full Name">
                            </div>
                        
                            <div class="form-group">
                                <label for="ndpInput">NDP</label>
                                <input type="text" class="form-control" id="ndpInput" placeholder="NDP">
                            </div>

                            <div class="form-group">
                                <label for="ndpInput">IC</label>
                                <input type="text" class="form-control" id="ndpInput" placeholder="IC">
                            </div>
                        
                            <div class="form-group">
                                <label for="phoneInput">Phone Number</label>
                                <input type="text" class="form-control" id="phoneInput" placeholder="Phone Number">
                            </div>
                        
                            <div class="form-group">
                                <label for="addressInput">Address</label>
                                <input type="text" class="form-control" id="addressInput" placeholder="Address">
                            </div>
                        
                            <div class="form-group">
                                <label for="kursusSelect">Kursus</label>
                                <select class="form-control" id="kursusSelect">
                                    <option value="" disabled selected>Select Kursus</option>
                                    <option value="kursus1">Sistem</option>
                                    <option value="kursus2">Perisian</option>
                                    <option value="kursus3">Cadd</option>
                                    <option value="kursus4">IPD</option>
                                    <option value="kursus5">Rangkaian</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                        
                            <div class="form-group">
                                <label for="semesterSelect">Semester</label>
                                <select class="form-control" id="semesterSelect">
                                    <option value="" disabled selected>Select Semester</option>
                                    <option value="semester1">Semester 1</option>
                                    <option value="semester2">Semester 2</option>
                                    <option value="semester3">Semester 3</option>
                                    <option value="semester4">Semester 4</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                        
                            <div class="form-group">
                                <label>Profile Picture</label>
                                <input type="file" name="profilePicture" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    </span>
                                </div>
                            </div>
                        
                        
                            <button type="submit" class="btn btn-primary me-2">Register</button>
                            <button type="button" class="btn btn-light">Cancel</button>
                        </form>
                        
                    </div>
                </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
@endsection