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
                            width="10" bgcolor="#ebb44a"></td>
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
                                                        style="color:#555555; font-family:Arial,sans-serif; font-size:14px; line-height:20px; text-align:left; text-transform:uppercase">
                                                        <p>Hi Managing Editor,</p>
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
                                                        <p>{{ $mentor->first_name.' '.$mentor->last_name }}
                                                            has uploaded a
                                                            new
                                                            essay: </p>
                                                        <br>
                                                        <b>Client:</b>
                                                        {{ $client->first_name.' '.$client->last_name }}
                                                        <br>
                                                        <b>Essay Title:</b>
                                                        {{ $essay_title }}
                                                        <br>
                                                        <b>Essay Deadline:</b>
                                                        {{ date('D, d M Y', strtotime($essay_deadline)) }}
                                                        <br>
                                                        <b>Application Due Date:</b>
                                                        {{ date('D, d M Y', strtotime($application_deadline)) }}
                                                        <br>
                                                        <b>Target University:</b>
                                                        {{ $university->university_name }}
                                                        <br>
                                                        <b>Essay Prompt:</b>
                                                        <i>{!! $essay_prompt !!}</i>
                                                        <br>

                                                        <p>Please assign this essay to
                                                            an
                                                            editor immediately.</p>
                                                        <br>
                                                        <a href="{{ url('/login/editor') }}"
                                                            style="background-color: #4CAF50;border: none;color: white; padding: 8px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 14px; margin: 4px 2px; cursor: pointer;">Assign
                                                            to Editor</a>
                                                        <br><br>
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