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
                            width="10" bgcolor="#78ce2d"></td>
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
                                                        Hi {{ $mentor->first_name.' '.$mentor->last_name }},
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
                                                        <p>{{ $client->first_name.' '.$client->last_name }}'s essay, {{ $essay->essay_title }}, has been reviewed by our essay editor, {{ $editor->first_name.' '.$editor->last_name }}, and is now ready to be returned to your mentee.</p>
                                                        <br>
                                                        <p>Please find the comments and/or suggestions for further revision in the document.</p> 
                                                        <br>
                                                        <p>You can download the revised essay in the attachment, or access it through the link below:</p>
                                                        <br>
                                                        @if ($essayEditor->managing_file)
                                                        <a href={{ asset('uploaded_files/program/essay/revised/'.$essayEditor->managing_file) }}
                                                        style="background-color: #4CAF50;border: none;color: white; padding: 8px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 14px; margin: 4px 2px; cursor: pointer;"
                                                        >Download</a>
                                                        @else
                                                            @if (str_contains($essayEditor->attached_of_editors, 'Revised'))
                                                                <a href={{ asset('uploaded_files/program/essay/editors/'.$essayEditor->attached_of_editors) }}
                                                                style="background-color: #4CAF50;border: none;color: white; padding: 8px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 14px; margin: 4px 2px; cursor: pointer;"
                                                                >Download</a>
                                                            @else
                                                                <a href={{ asset('uploaded_files/program/essay/editors/'.$essayEditor->attached_of_editors) }}
                                                                style="background-color: #4CAF50;border: none;color: white; padding: 8px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 14px; margin: 4px 2px; cursor: pointer;"
                                                                >Download</a>
                                                            @endif
                                                        @endif
                                                        
                                                        
                                                        <br>
                                                        <br>
                                                        <p>Thanks! Please feel free to contact us if you have further questions. </p>

                                                    </div>
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