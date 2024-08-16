@extends('layouts.email')

@section('content')
    <layout label='Section 4'>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td>
                    <!-- Row Green -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                        <tr>
                            <td class="img" style="font-size:0pt; line-height:0pt; text-align:left" width="10"
                                bgcolor="#ffa114"></td>
                            <td class="img" style="font-size:0pt; line-height:0pt; text-align:left" width="22"></td>
                            <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <!-- Column -->
                                        <th class="column"
                                            style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; Margin:0"
                                            width="404">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td width="404">
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                            class="spacer"
                                                            style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                            <tr>
                                                                <td height="15" class="spacer"
                                                                    style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                                    &nbsp;</td>
                                                            </tr>
                                                        </table>

                                                        <div class="h5-2"
                                                            style="color:#555555; font-family:Arial,sans-serif; font-size:14px; line-height:20px; text-align:left; text-transform:capitalize">
                                                            <p>Hi {{ $editor->first_name . ' ' . $editor->last_name }},</p>
                                                        </div>
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                            class="spacer"
                                                            style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                            <tr>
                                                                <td height="6" class="spacer"
                                                                    style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                                    &nbsp;</td>
                                                            </tr>
                                                        </table>

                                                        <div class="text2"
                                                            style="color:#777777; font-family:Arial,sans-serif; font-size:12px; line-height:20px; text-align:left">
                                                            <br>
                                                            <p>After reviewing your revision of
                                                                {{ $client->first_name . ' ' . $client->last_name }}'s essay,
                                                                {{ $essay->essay_title }},
                                                                {{ $managing->first_name . ' ' . $managing->last_name }} is
                                                                asking you to please give it another look.</p>
                                                            <br>
                                                            <p>You can find the managing editor's comments, including why
                                                                they are requesting further revision, along with the
                                                                client's essay and all the relevant information by clicking
                                                                on the link below: </p>
                                                            <br>
                                                            <a href="{{ url('/login/editor') }}"
                                                                style="background-color: #4CAF50;border: none;color: white; padding: 8px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 14px; margin: 4px 2px; cursor: pointer;">Check
                                                                Your Revision</a>
                                                            <br><br>
                                                            <p>Please complete this revision process by
                                                                <b>{{ date('D, d M Y', strtotime($revise->created_at . '+1 day')) }}</b>.
                                                            </p>
                                                            <br>
                                                            <p>Thanks! Please feel free to contact your managing editor if
                                                                you have further questions or concerns. </p>

                                                        </div>
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                            class="spacer"
                                                            style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                            <tr>
                                                                <td height="15" class="spacer"
                                                                    style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                                    &nbsp;</td>
                                                            </tr>
                                                        </table>

                                                    </td>
                                                </tr>
                                            </table>
                                        </th>
                                    </tr>
                                </table>
                            </td>
                            <td class="content-spacing" style="font-size:0pt; line-height:0pt; text-align:left"
                                width="30"></td>
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
