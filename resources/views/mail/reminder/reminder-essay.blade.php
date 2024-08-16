@extends('layouts.email')

@section('content')

<layout label='Section 4'>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <!-- Row Green -->
                <table width="100%" border="0" cellspacing="0" cellpadding="0"
                    bgcolor="#ffffff">
                    <tr>
                        <td class="img"
                            style="font-size:0pt; line-height:0pt; text-align:left"
                            width="10" bgcolor="#2079a3"></td>
                        <td class="img"
                            style="font-size:0pt; line-height:0pt; text-align:left"
                            width="22"></td>
                        <td>
                            <table width="100%" border="0" cellspacing="0"
                                cellpadding="0">
                                <tr>
                                    <!-- Column -->
                                    <th class="column"
                                        style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; Margin:0"
                                        width="404">
                                        <table width="100%" border="0" cellspacing="0"
                                            cellpadding="0">
                                            <tr>
                                                <td width="404">
                                                    <table width="100%" border="0"
                                                        cellspacing="0" cellpadding="0"
                                                        class="spacer"
                                                        style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                        <tr>
                                                            <td height="15"
                                                                class="spacer"
                                                                style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                                &nbsp;</td>
                                                        </tr>
                                                    </table>

                                                    <div class="h5-2"
                                                        style="color:#555555; font-family:Arial,sans-serif; font-size:14px; line-height:20px; text-align:left; text-transform:capitalize">
                                                        @if ($role == 'managing')
                                                            <p>Hello Managing Editor!</p>
                                                        @else
                                                            <p>Hello {{ $name }}!</p>
                                                        @endif
                                                    </div>
                                                    <table width="100%" border="0"
                                                        cellspacing="0" cellpadding="0"
                                                        class="spacer"
                                                        style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                        <tr>
                                                            <td height="6"
                                                                class="spacer"
                                                                style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                                &nbsp;</td>
                                                        </tr>
                                                    </table>

                                                    <div class="text2"
                                                        style="color:#777777; font-family:Arial,sans-serif; font-size:12px; line-height:20px; text-align:left">
                                                        <br>
                                                        @if ($role == 'managing')
                                                            <p>Thanks for making sure that the essays we return to the mentees are of the highest quality!</p>
                                                            <br>
                                                            <p>Here are the essays that are awaiting your review today:</p>
                                                            @include('mail.reminder.tablelist')
                                                            <br>
                                                            <p>Your feedback is so important to the effectiveness of these essays, which can be a game-changer for our mentees' university application. Please kindly review these essays promptly.</p>
                                                            <br>
                                                            <p>You can log in <a href="{{ url('/login/editor') }}">here</a> to review these essays. Thank you!</p>
                                                            <br>
                                                        @else
                                                            <p>Thanks for your dedication to maintaining the excellence of essays on our platform. Your expertise greatly contributes to shaping the future of our mentees' university applications.</p>
                                                            <br>
                                                            <p>We wanted to remind you that there's an essay awaiting your review. Your insightful feedback is instrumental in refining the essay and helping the mentee put their best foot forward!</p>
                                                            <br>
                                                            @include('mail.reminder.tablelist')
                                                            <br>
                                                            <p>Please log in <a href="{{ url('/login/editor') }}">here</a> to review the essay and provide your valuable insights. Your attention to this review will significantly impact the quality of the essay and the mentee's application success.</p>
                                                            <br>
                                                            <p>Thank you!</p>
                                                            <br>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </th>
                                    <!-- END Column -->
                                </tr>
                            </table>
                        </td>
                        <td class="content-spacing"
                            style="font-size:0pt; line-height:0pt; text-align:left"
                            width="30"></td>
                    </tr>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0"
                    class="spacer"
                    style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                    <tr>
                        <td height="10" class="spacer"
                            style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                            &nbsp;</td>
                    </tr>
                </table>

                <!-- END Row Green -->
            </td>
        </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer"
        style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
        <tr>
            <td height="10" class="spacer"
                style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                &nbsp;</td>
        </tr>
    </table>

</layout>
@endsection