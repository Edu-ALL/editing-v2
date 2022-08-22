@extends('user.admin.utama.utama')
@section('css')
  <link rel="stylesheet" href="/css/admin/help.css">
@endsection

@section('content')
<div class="container-fluid" style="padding: 0">
  <div class="row flex-nowrap main">

    {{-- Sidenav --}}
    @include('user.admin.utama.menu')

    {{-- Content --}}
    <div class="col" style="overflow: auto !important">
      @include('user.admin.utama.head')
      <div class="container main-content m-0">
        <div class="row gap-2">
          <div class="col-md col-12 p-0 userCard profile" style="overflow-y: auto">
            <div class="headline d-flex align-items-center gap-3">
              <img src="/assets/recommend.png" alt="">
              <h6>Recommendations</h6>
            </div>
            {{-- browser --}}
            <div class="col wrap-content d-flex align-items-center justify-content-start py-3" type="button" data-bs-toggle="collapse" data-bs-target="#browser">
              <div class="row w-100 content align-items-center justify-content-between px-3">
                <div class="col p-0 me-3">
                  <h6>Use the google chrome browser application</h6>
                </div>
                <div class="col-auto p-0">
                  <img src="/assets/direct-yellow.png" alt="">
                </div>
              </div>
            </div>
            {{-- extension --}}
            <div class="col wrap-content d-flex align-items-center justify-content-start py-3" type="button" data-bs-toggle="collapse" data-bs-target="#extension">
              <div class="row w-100 content align-items-center justify-content-between px-3">
                <div class="col p-0 me-3">
                  <h6>Install the docs viewer extension on google chrome.</h6>
                </div>
                <div class="col-auto p-0">
                  <img src="/assets/direct-yellow.png" alt="">
                </div>
              </div>
            </div>
            {{-- track --}}
            <div class="col wrap-content d-flex align-items-center justify-content-start py-3" type="button" data-bs-toggle="collapse" data-bs-target="#track">
              <div class="row w-100 content align-items-center justify-content-between px-3">
                <div class="col p-0 me-3">
                  <h6>Activate <b>Track Changes</b> on your essay document (docx).</h6>
                </div>
                <div class="col-auto p-0">
                  <img src="/assets/direct-yellow.png" alt="">
                </div>
              </div>
            </div>

            <div class="headline d-flex align-items-center gap-3" style="border-radius: 0">
              <img src="/assets/help.png" alt="">
              <h6>Help</h6>
            </div>
            {{-- university --}}
            <div class="col wrap-content d-flex align-items-center justify-content-start py-3" type="button" data-bs-toggle="collapse" data-bs-target="#univ">
              <div class="row w-100 content align-items-center justify-content-between px-3">
                <div class="col p-0 me-3">
                  <h6>How to add a new university?</h6>
                </div>
                <div class="col-auto p-0">
                  <img src="/assets/direct-yellow.png" alt="">
                </div>
              </div>
            </div>
            {{-- essay prompt --}}
            <div class="col wrap-content d-flex align-items-center justify-content-start py-3" type="button" data-bs-toggle="collapse" data-bs-target="#prompt">
              <div class="row w-100 content align-items-center justify-content-between px-3">
                <div class="col p-0 me-3">
                  <h6>How to add a new essay prompt?</h6>
                </div>
                <div class="col-auto p-0">
                  <img src="/assets/direct-yellow.png" alt="">
                </div>
              </div>
            </div>
            {{-- program --}}
            <div class="col wrap-content d-flex align-items-center justify-content-start py-3" type="button" data-bs-toggle="collapse" data-bs-target="#program">
              <div class="row w-100 content align-items-center justify-content-between px-3">
                <div class="col p-0 me-3">
                  <h6>How to add a new program?</h6>
                </div>
                <div class="col-auto p-0">
                  <img src="/assets/direct-yellow.png" alt="">
                </div>
              </div>
            </div>
            {{-- category/tags --}}
            <div class="col wrap-content d-flex align-items-center justify-content-start py-3" type="button" data-bs-toggle="collapse" data-bs-target="#tags">
              <div class="row w-100 content align-items-center justify-content-between px-3">
                <div class="col p-0 me-3">
                  <h6>How to add a new categories/tags?</h6>
                </div>
                <div class="col-auto p-0">
                  <img src="/assets/direct-yellow.png" alt="">
                </div>
              </div>
            </div>
            {{-- syncstudent --}}
            <div class="col wrap-content d-flex align-items-center justify-content-start py-3" type="button" data-bs-toggle="collapse" data-bs-target="#syncstudent">
              <div class="row w-100 content align-items-center justify-content-between px-3">
                <div class="col p-0 me-3">
                  <h6>How to synchronization students data with CRM system?</h6>
                </div>
                <div class="col-auto p-0">
                  <img src="/assets/direct-yellow.png" alt="">
                </div>
              </div>
            </div>
            {{-- syncmentor --}}
            <div class="col wrap-content d-flex align-items-center justify-content-start py-3" type="button" data-bs-toggle="collapse" data-bs-target="#syncmentor">
              <div class="row w-100 content align-items-center justify-content-between px-3">
                <div class="col p-0 me-3">
                  <h6>How to synchronization mentors data with CRM system?</h6>
                </div>
                <div class="col-auto p-0">
                  <img src="/assets/direct-yellow.png" alt="">
                </div>
              </div>
            </div>
            {{-- add editor --}}
            <div class="col wrap-content d-flex align-items-center justify-content-start py-3" type="button" data-bs-toggle="collapse" data-bs-target="#addeditor">
              <div class="row w-100 content align-items-center justify-content-between px-3">
                <div class="col p-0 me-3">
                  <h6>How to add a new editor?</h6>
                </div>
                <div class="col-auto p-0">
                  <img src="/assets/direct-yellow.png" alt="">
                </div>
              </div>
            </div>
            {{-- invite editor --}}
            <div class="col wrap-content d-flex align-items-center justify-content-start py-3" type="button" data-bs-toggle="collapse" data-bs-target="#inviteeditor">
              <div class="row w-100 content align-items-center justify-content-between px-3">
                <div class="col p-0 me-3">
                  <h6>How to invite a new editor?</h6>
                </div>
                <div class="col-auto p-0">
                  <img src="/assets/direct-yellow.png" alt="">
                </div>
              </div>
            </div>
            {{-- assign editor --}}
            <div class="col wrap-content d-flex align-items-center justify-content-start py-3" type="button" data-bs-toggle="collapse" data-bs-target="#assigneditor">
              <div class="row w-100 content align-items-center justify-content-between px-3">
                <div class="col p-0 me-3">
                  <h6>How to assign to the editor?</h6>
                </div>
                <div class="col-auto p-0">
                  <img src="/assets/direct-yellow.png" alt="">
                </div>
              </div>
            </div>
            {{-- cancel editor --}}
            <div class="col wrap-content d-flex align-items-center justify-content-start py-3" type="button" data-bs-toggle="collapse" data-bs-target="#canceleditor">
              <div class="row w-100 content align-items-center justify-content-between px-3">
                <div class="col p-0 me-3">
                  <h6>How to cancel the editor's assignment?</h6>
                </div>
                <div class="col-auto p-0">
                  <img src="/assets/direct-yellow.png" alt="">
                </div>
              </div>
            </div>
            {{-- revise --}}
            <div class="col wrap-content d-flex align-items-center justify-content-start py-3" type="button" data-bs-toggle="collapse" data-bs-target="#revise">
              <div class="row w-100 content align-items-center justify-content-between px-3">
                <div class="col p-0 me-3">
                  <h6>How to revise editor's essay?</h6>
                </div>
                <div class="col-auto p-0">
                  <img src="/assets/direct-yellow.png" alt="">
                </div>
              </div>
            </div>
            {{-- accept --}}
            <div class="col wrap-content d-flex align-items-center justify-content-start py-3" type="button" data-bs-toggle="collapse" data-bs-target="#accept">
              <div class="row w-100 content align-items-center justify-content-between px-3">
                <div class="col p-0 me-3">
                  <h6>How to accept editor's essay?</h6>
                </div>
                <div class="col-auto p-0">
                  <img src="/assets/direct-yellow.png" alt="">
                </div>
              </div>
            </div>
            {{-- send --}}
            <div class="col wrap-content d-flex align-items-center justify-content-start py-3" type="button" data-bs-toggle="collapse" data-bs-target="#send">
              <div class="row w-100 content align-items-center justify-content-between px-3">
                <div class="col p-0 me-3">
                  <h6>How to send editor's essay to student/mentor?</h6>
                </div>
                <div class="col-auto p-0">
                  <img src="/assets/direct-yellow.png" alt="">
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-md-8 col-12 p-0 userCard profile" style="overflow-y: auto">
            <div id="accordion">
              {{-- browser --}}
              <div class="collapse" id="browser" data-bs-parent="#accordion">
                <div class="headline d-flex justify-content-between" style="padding: 30px 24px !important">
                  <div class="col d-flex align-items-center gap-md-3 gap-2">
                    <h6>Use the google chrome browser application</h6>
                  </div>
                </div>
                <div class="row profile-editor px-md-3 py-md-4 px-2 py-4">
                  <div class="col d-flex flex-column gap-3">
                    <h6>Google Chrome is one of the most popular browsers on any platform, whether on a smartphone or on a desktop.</h6>
                    <h6>How to Install the Google Chrome Browser on Windows 7, 8, 10</h6>
                    <ul class="d-flex flex-column gap-2 ps-md-4 ps-3">
                      <li>First download the software at <a href="https://www.google.com/chrome/">Google
                        Chrome</a>.</li>
                      <li>After you download, run the installer file that was downloaded earlier.</li>
                      <li>Let the installer run to download the compatibility files until they are finished.</li>
                      <li>When finished, the Google Chrome browser will open and display a Welcome page.</li>
                    </ul>
                  </div>
                </div>
              </div>
              {{-- extension --}}
              <div class="collapse" id="extension" data-bs-parent="#accordion">
                <div class="headline d-flex justify-content-between" style="padding: 30px 24px !important">
                  <div class="col d-flex align-items-center gap-md-3 gap-2">
                    <h6>Install the docs viewer extension on google chrome.</h6>
                  </div>
                </div>
                <div class="row profile-editor px-md-3 py-md-4 px-2 py-4">
                  <div class="col d-flex flex-column gap-3">
                    <ul class="d-flex flex-column gap-2 ps-md-4 ps-3">
                      <li>Please go to <a href="https://chrome.google.com/webstore/category/extensions">Google Chrome Extension</a>.</li>
                      <li>Type Office Editing in the search field or go to <a href="https://chrome.google.com/webstore/detail/office-editing-for-docs-s/gbkeegbaiigmenfmjfclcdgdpimamgkj">Office Editing</a>.</li>
                      <li>Click the Add to Chrome button.</li>
                      <li>If the extension is not compatible, please update your Google Chrome browser application.</li>
                    </ul>
                  </div>
                </div>
              </div>
              {{-- track --}}
              <div class="collapse" id="track" data-bs-parent="#accordion">
                <div class="headline d-flex justify-content-between" style="padding: 30px 24px !important">
                  <div class="col d-flex align-items-center gap-md-3 gap-2">
                    <h6>Activate Track Changes on your essay document (docx).</h6>
                  </div>
                </div>
                <div class="row profile-editor px-md-3 py-md-4 px-2 py-4">
                  <div class="col d-flex flex-column gap-3">
                    <h6>When you make a document that is opened or opened with someone else, it is necessary to change what has been changed, who made the change, and whenever the change was made.</h6>
                    <ul class="d-flex flex-column gap-2 ps-md-4 ps-3">
                      <li>On the Review tab, in the <b>Tracking group</b>, click <b>Track Changes</b> (if it's not already selected).</li>
                      <li>Click the drop-down list at the top of the <b>Tracking group</b> and select <b>All Markup</b> (if not already selected).</li>
                    </ul>
                  </div>
                </div>
              </div>
              {{-- university --}}
              <div class="collapse" id="univ" data-bs-parent="#accordion">
                <div class="headline d-flex justify-content-between" style="padding: 30px 24px !important">
                  <div class="col d-flex align-items-center gap-md-3 gap-2">
                    <h6>Add a new university</h6>
                  </div>
                </div>
                <div class="row profile-editor px-md-3 py-md-4 px-2 py-4">
                  <div class="col d-flex flex-column gap-3">
                    <ul class="d-flex flex-column gap-2 ps-md-4 ps-3">
                      <li>Click <b>Settings</b> menu, choose <b>University</b></li>
                      <li>Click <span class="mx-1"><img src="/assets/add.png" alt="" height="14"></span> button to add a new university.</li>
                      <img src="/assets/help/add-university.png" alt="" width="100%">
                    </ul>
                  </div>
                </div>
              </div>
              {{-- essay prompt --}}
              <div class="collapse" id="prompt" data-bs-parent="#accordion">
                <div class="headline d-flex justify-content-between" style="padding: 30px 24px !important">
                  <div class="col d-flex align-items-center gap-md-3 gap-2">
                    <h6>Add a new essay prompt</h6>
                  </div>
                </div>
                <div class="row profile-editor px-md-3 py-md-4 px-2 py-4">
                  <div class="col d-flex flex-column gap-3">
                    <ul class="d-flex flex-column gap-2 ps-md-4 ps-3">
                      <li>Click <b>Settings</b> menu, choose <b>Essay Prompt</b></li>
                      <li>Click <span class="mx-1"><img src="/assets/add.png" alt="" height="14"></span> button to add a new essay prompt.</li>
                      <img src="/assets/help/add-essay-prompt.png" alt="" width="100%">
                    </ul>
                  </div>
                </div>
              </div>
              {{-- programs --}}
              <div class="collapse" id="program" data-bs-parent="#accordion">
                <div class="headline d-flex justify-content-between" style="padding: 30px 24px !important">
                  <div class="col d-flex align-items-center gap-md-3 gap-2">
                    <h6>Add a new program</h6>
                  </div>
                </div>
                <div class="row profile-editor px-md-3 py-md-4 px-2 py-4">
                  <div class="col d-flex flex-column gap-3">
                    <ul class="d-flex flex-column gap-2 ps-md-4 ps-3">
                      <li>Click <b>Settings</b> menu, choose <b>Programs</b></li>
                      <li>Click <span class="mx-1"><img src="/assets/add.png" alt="" height="14"></span> button to add a new program.</li>
                      <img src="/assets/help/add-program.png" alt="" width="100%">
                    </ul>
                  </div>
                </div>
              </div>
              {{-- category/tags --}}
              <div class="collapse" id="tags" data-bs-parent="#accordion">
                <div class="headline d-flex justify-content-between" style="padding: 30px 24px !important">
                  <div class="col d-flex align-items-center gap-md-3 gap-2">
                    <h6>Add a new categories/tags</h6>
                  </div>
                </div>
                <div class="row profile-editor px-md-3 py-md-4 px-2 py-4">
                  <div class="col d-flex flex-column gap-3">
                    <ul class="d-flex flex-column gap-2 ps-md-4 ps-3">
                      <li>Click <b>Settings</b> menu, choose <b>Categories/Tags</b></li>
                      <li>Click <span class="mx-1"><img src="/assets/add.png" alt="" height="14"></span> button to add a new categories/tags.</li>
                      <img src="/assets/help/add-category.png" alt="" width="100%">
                    </ul>
                  </div>
                </div>
              </div>
              {{-- syncstudent --}}
              <div class="collapse" id="syncstudent" data-bs-parent="#accordion">
                <div class="headline d-flex justify-content-between" style="padding: 30px 24px !important">
                  <div class="col d-flex align-items-center gap-md-3 gap-2">
                    <h6>Synchronization students data with CRM system.</h6>
                  </div>
                </div>
                <div class="row profile-editor px-md-3 py-md-4 px-2 py-4">
                  <div class="col d-flex flex-column gap-3">
                    <ul class="d-flex flex-column gap-2 ps-md-4 ps-3">
                      <li>Click <b>Users</b> menu, choose <b>Students</b></li>
                      <li>Click <span class="mx-1"><img src="/assets/reload.png" alt="" height="14"></span> button to synchronization data.</li>
                      <img src="/assets/help/sync-student.png" alt="" width="100%">
                    </ul>
                  </div>
                </div>
              </div>
              {{-- syncmentor --}}
              <div class="collapse" id="syncmentor" data-bs-parent="#accordion">
                <div class="headline d-flex justify-content-between" style="padding: 30px 24px !important">
                  <div class="col d-flex align-items-center gap-md-3 gap-2">
                    <h6>Synchronization mentors data with CRM system.</h6>
                  </div>
                </div>
                <div class="row profile-editor px-md-3 py-md-4 px-2 py-4">
                  <div class="col d-flex flex-column gap-3">
                    <ul class="d-flex flex-column gap-2 ps-md-4 ps-3">
                      <li>Click <b>Users</b> menu, choose <b>Mentors</b></li>
                      <li>Click <span class="mx-1"><img src="/assets/reload.png" alt="" height="14"></span> button to synchronization data.</li>
                      <img src="/assets/help/sync-mentor.png" alt="" width="100%">
                    </ul>
                  </div>
                </div>
              </div>
              {{-- add editor --}}
              <div class="collapse" id="addeditor" data-bs-parent="#accordion">
                <div class="headline d-flex justify-content-between" style="padding: 30px 24px !important">
                  <div class="col d-flex align-items-center gap-md-3 gap-2">
                    <h6>Add a new editor.</h6>
                  </div>
                </div>
                <div class="row profile-editor px-md-3 py-md-4 px-2 py-4">
                  <div class="col d-flex flex-column gap-3">
                    <ul class="d-flex flex-column gap-2 ps-md-4 ps-3">
                      <li>Click <b>Users</b> menu, choose <b>Editors</b></li>
                      <li>Click <span class="mx-1"><img src="/assets/add.png" alt="" height="14"></span> button to add a new editor.</li>
                      <img src="/assets/help/add-editor.png" alt="" width="100%">
                    </ul>
                  </div>
                </div>
              </div>
              {{-- invite editor --}}
              <div class="collapse" id="inviteeditor" data-bs-parent="#accordion">
                <div class="headline d-flex justify-content-between" style="padding: 30px 24px !important">
                  <div class="col d-flex align-items-center gap-md-3 gap-2">
                    <h6>Invite a new editor.</h6>
                  </div>
                </div>
                <div class="row profile-editor px-md-3 py-md-4 px-2 py-4">
                  <div class="col d-flex flex-column gap-3">
                    <ul class="d-flex flex-column gap-2 ps-md-4 ps-3">
                      <li>Click <b>Users</b> menu, choose <b>Editors</b></li>
                      <li>Click <span class="mx-1"><img src="/assets/letter.png" alt="" height="14"></span> button to invite a new editor.</li>
                      <img src="/assets/help/invite-editor.png" alt="" width="100%">
                    </ul>
                  </div>
                </div>
              </div>
              {{-- assign editor --}}
              <div class="collapse" id="assigneditor" data-bs-parent="#accordion">
                <div class="headline d-flex justify-content-between" style="padding: 30px 24px !important">
                  <div class="col d-flex align-items-center gap-md-3 gap-2">
                    <h6>Assignment to the editor.</h6>
                  </div>
                </div>
                <div class="row profile-editor px-md-3 py-md-4 px-2 py-4">
                  <div class="col d-flex flex-column gap-3">
                    <ul class="d-flex flex-column gap-2 ps-md-4 ps-3">
                      <li>Click <b>Essay List</b> menu, choose <b>Ongoing Essay</b></li>
                      <li>Click <b>Select Editor</b> button</li>
                      <img src="/assets/help/btn-select-editor.png" alt="" width="50%">
                      <li>Select the editor according to graduated from, major, etc.</li>
                      <img src="/assets/help/list-select-editor.png" alt="" width="100%">
                    </ul>
                  </div>
                </div>
              </div>
              {{-- cancel editor --}}
              <div class="collapse" id="canceleditor" data-bs-parent="#accordion">
                <div class="headline d-flex justify-content-between" style="padding: 30px 24px !important">
                  <div class="col d-flex align-items-center gap-md-3 gap-2">
                    <h6>Cancel the editor's assignment.</h6>
                  </div>
                </div>
                <div class="row profile-editor px-md-3 py-md-4 px-2 py-4">
                  <div class="col d-flex flex-column gap-3">
                    <ul class="d-flex flex-column gap-2 ps-md-4 ps-3">
                      <li>Click <b>Essay List</b> menu, choose <b>Ongoing Essay</b></li>
                      <li>Click <b>Cancel</b> button</li>
                      <img src="/assets/help/cancel-editor.png" alt="" width="50%">
                    </ul>
                  </div>
                </div>
              </div>
              {{-- revise --}}
              <div class="collapse" id="revise" data-bs-parent="#accordion">
                <div class="headline d-flex justify-content-between" style="padding: 30px 24px !important">
                  <div class="col d-flex align-items-center gap-md-3 gap-2">
                    <h6>Make revisions to the editor.</h6>
                  </div>
                </div>
                <div class="row profile-editor px-md-3 py-md-4 px-2 py-4">
                  <div class="col d-flex flex-column gap-3">
                    <ul class="d-flex flex-column gap-2 ps-md-4 ps-3">
                      <li>Click <b>Essay List</b> menu, choose <b>Ongoing Essay</b></li>
                      <li>Give notes that will be revised by the editor.</li>
                      <li>Click <b>Revise</b> button</li>
                      <img src="/assets/help/revise.png" alt="" width="50%">
                    </ul>
                  </div>
                </div>
              </div>
              {{-- accept --}}
              <div class="collapse" id="accept" data-bs-parent="#accordion">
                <div class="headline d-flex justify-content-between" style="padding: 30px 24px !important">
                  <div class="col d-flex align-items-center gap-md-3 gap-2">
                    <h6>Accept the editor's essay.</h6>
                  </div>
                </div>
                <div class="row profile-editor px-md-3 py-md-4 px-2 py-4">
                  <div class="col d-flex flex-column gap-3">
                    <ul class="d-flex flex-column gap-2 ps-md-4 ps-3">
                      <li>Click <b>Essay List</b> menu, choose <b>Ongoing Essay</b></li>
                      <li>Click <b>Accept</b> button</li>
                      <img src="/assets/help/accept.png" alt="" width="100%">
                    </ul>
                  </div>
                </div>
              </div>
              {{-- send --}}
              <div class="collapse" id="send" data-bs-parent="#accordion">
                <div class="headline d-flex justify-content-between" style="padding: 30px 24px !important">
                  <div class="col d-flex align-items-center gap-md-3 gap-2">
                    <h6>Send to Student/Mentor.</h6>
                  </div>
                </div>
                <div class="row profile-editor px-md-3 py-md-4 px-2 py-4">
                  <div class="col d-flex flex-column gap-3">
                    <ul class="d-flex flex-column gap-2 ps-md-4 ps-3">
                      <li>Click <b>Essay List</b> menu, choose <b>Completed Essay</b></li>
                      <li>Click <b>Send to Student / Mentor</b> button</li>
                      <img src="/assets/help/send.png" alt="" width="100%">
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- End Content --}}
  </div>
</div>
@endsection