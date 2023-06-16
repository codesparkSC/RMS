<div>
    <div>
       <u></u>
    <div style="background-color:#fafafa">
       <div style="background-color:#fafafa">
          <div style="background:#fbfdff;background-color:#fbfdff;Margin:0px auto;max-width:unset">
             <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#fbfdff;background-color:#fbfdff;width:100%">
                <tbody>
                   <tr>
                      <td style="direction:ltr;font-size:0px;padding:0px;text-align:center;vertical-align:top">
                      </td>
                   </tr>
                </tbody>
             </table>
          </div>
          <div style="background:#900096;background-color:#900096;Margin:0px auto;max-width:unset">
             <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#900096;background-color:#900096;width:100%">
                <tbody>
                   <tr>
                      <td style="direction:ltr;font-size:0px;padding:0px;text-align:center;vertical-align:top">
                         <div class="m_-2309046304354521016mj-column-per-100" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%">
                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                               <tbody>
                                  <tr>
                                     <td style="vertical-align:top;padding:0px">
                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                                           <tbody><tr>
                                              <td align="left" style="font-size:0px;padding:0px;word-break:break-word">
                                                 <div style="font-family:Trebuchet MS;font-size:13px;line-height:1;text-align:left;color:#000000">
                                                    <div style="box-sizing:border-box;max-width:100%">
                                                       <div style="width:85%;width:calc(46000% - 211600px);max-width:460px;min-width:308px;margin-left:auto;margin-right:auto;box-sizing:border-box;padding-left:16px;padding-right:16px;border-radius:2px;padding-top:18px;padding-bottom:18px">
                                                          <div style="text-align:center;width:fit-content;margin:0 auto;font-size:16px;line-height:1.5;color:#0d2366">
                                                             <div style="display:inline-block;vertical-align:middle;background-color:#ffffff;box-sizing:border-box;line-height:0">
                                                                
                                                             </div>
                                                             <div style="display:inline-block;vertical-align:middle;margin-left:10px;color:#ffffff">
                                                                Boleh.Store
                                                             </div>
                                                          </div>
                                                       </div>
                                                       {{-- @php($total = 0);
                                                       @foreach($data['order_list'] as $o)
                                                       {{$total+=$o->price * $o->quantity}}
                                                       @endforeach --}}
                                                       <div style="width:85%;width:calc(46000% - 211600px);max-width:460px;min-width:308px;margin-left:auto;margin-right:auto;box-sizing:border-box;padding-left:16px;padding-right:16px;border-radius:2px;background-color:#ffffff;padding-top:12px;border-bottom-left-radius:0;border-bottom-right-radius:0">
                                                          <div style="text-align:center;width:fit-content;margin:0 auto">
                                                             <div style="box-sizing:border-box;display:inline-block;max-width:100%"><span style="font-size:24px;line-height:1.5;color:#0d2366">{{$data['seller']->seller ?? 'RM'}}</span><span style="font-size:24px;line-height:1.5;color:#0d2366">{{$data['order']->total_payment}}</span><span style="font-size:16px;line-height:1.5;color:#515978"></span>
                                                             </div>
                                                          </div>
                                                       </div>
                                                    </div>
                                                 </div>
                                              </td>
                                           </tr>
                                        </tbody></table>
                                     </td>
                                  </tr>
                               </tbody>
                            </table>
                         </div>
                      </td>
                   </tr>
                </tbody>
             </table>
          </div>
          <div style="Margin:0px auto;max-width:unset">
             <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%">
                <tbody>
                   <tr>
                      <td style="direction:ltr;font-size:0px;padding:0px;text-align:center;vertical-align:top">
                         <div class="m_-2309046304354521016mj-column-per-100" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%">
                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                               <tbody>
                                  <tr>
                                     <td style="vertical-align:top;padding:0px">
                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                                           <tbody><tr>
                                              <td align="left" style="font-size:0px;padding:0px;word-break:break-word">
                                                 <div style="font-family:Trebuchet MS;font-size:13px;line-height:1;text-align:left;color:#000000">
                                                    <div style="width:85%;width:calc(46000% - 211600px);max-width:460px;min-width:308px;margin-left:auto;margin-right:auto;box-sizing:border-box;padding-left:16px;padding-right:16px;border-radius:2px;background-color:#ffffff;padding-bottom:16px;border-top-left-radius:0;border-top-right-radius:0">
                                                       <div style="text-align:center">
                                                          <div style="margin:0;font-size:16px;line-height:1.5;color:#7b8199">
                                                             <div style="display:inline-block;width: 100%;text-align: center;">#{{$data['order']->id}}</div>
                                                             <div style="display:inline-block">&nbsp;<span class="il">Order </span> Placed and ship till {{date('j F,Y',strtotime($data['order']->seller_delivery_date))}}
                                                             </div>
                                                             <hr style="opacity:0.2;margin:16px 0">
                                                          </div>
                                                       </div>
                                                    </div>
                                                 </div>
                                              </td>
                                           </tr>
                                        </tbody></table>
                                     </td>
                                  </tr>
                               </tbody>
                            </table>
                         </div>
                      </td>
                   </tr>
                </tbody>
             </table>
          </div>
          <div style="Margin:0px auto;max-width:unset">
             <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%">
                <tbody>
                   <tr>
                      <td style="direction:ltr;font-size:0px;padding:0px;text-align:center;vertical-align:top">
                         <div class="m_-2309046304354521016mj-column-per-100" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%">
                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                               <tbody>
                                  <tr>
                                     <td style="vertical-align:top;padding:0px">
                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                                           <tbody><tr>
                                              <td align="left" style="font-size:0px;padding:0px;word-break:break-word">
                                                 <div style="font-family:Trebuchet MS;font-size:13px;line-height:1;text-align:left;color:#000000">
                                                    <div style="width:85%;width:calc(46000% - 211600px);max-width:460px;min-width:308px;margin-left:auto;margin-right:auto;box-sizing:border-box;padding-left:16px;padding-right:16px;border-radius:2px;background-color:#ffffff;border-top-width:0px;border-top-style:solid;padding-top:20px;padding-bottom:20px;border-top-color:#069baa;margin-top:8px">
                                                       <div>
                                                          <div >
                                                             <span style="font-size: 18px;margin-top: 5px;font-weight: 600;">Order Details</span> 
                                                          </div>
                                                       </div>
                                                       <div >
                                                        @foreach($data['order_list'] as $o)
                                                          <div style="font-size: 12px;margin-top: 5px;font-weight: 600;">
                                                            {{$o->product_name}} X {{$o->quantity}}
                                                          </div>
                                                          {{-- <div style="font-size: 12px;margin-top: 5px;font-weight: 600;">
                                                            Coarse Wheat atta X 1
                                                          </div>
                                                          <div style="font-size: 12px;margin-top: 5px;font-weight: 600;">
                                                            Coarse Wheat atta X 1
                                                          </div>
                                                          <div style="font-size: 12px;margin-top: 5px;font-weight: 600;">
                                                            Coarse Wheat atta X 1
                                                          </div> --}}
                                                          @endforeach
                                                       </div>
                                                       <div >
                                                          <div style="font-size: 12px;margin-top: 15px;font-weight: 600;margin-bottom: 10px;">
                                                             <span class="il">Payment</span> via
                                                          </div>
                                                          <div style="font-size: 18px;margin-top: 5px;font-weight: 600;">
                                                             NetBanking
                                                          </div>
                                                          <div style="font-size: 12px;margin-top: 5px;font-weight: 600;">
                                                                Banking Details 
                                                          </div>
                                                          <div style="font-size: 12px;margin-top: 5px;font-weight: 600;">
                                                               {{$data['seller']->bank_name ?? ''}}
                                                          </div>
                                                          <div style="font-size: 12px;margin-top: 5px;font-weight: 600;">
                                                                Account Number :{{$data['seller']->bank_account_no ?? ''}}
                                                          </div>
                                                       </div>
                                                    </div>
                                                 </div>
                                              </td>
                                           </tr>
                                        </tbody></table>
                                     </td>
                                  </tr>
                               </tbody>
                            </table>
                         </div>
                      </td>
                   </tr>
                </tbody>
             </table>
          </div>
          <div style="Margin:0px auto;max-width:unset">
             <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%">
                <tbody>
                   <tr>
                      <td style="direction:ltr;font-size:0px;padding:0px;text-align:center;vertical-align:top">
                      </td>
                   </tr>
                </tbody>
             </table>
          </div>
          <div style="Margin:0px auto;max-width:unset">
             <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%">
                <tbody>
                   <tr>
                      <td style="direction:ltr;font-size:0px;padding:0px;text-align:center;vertical-align:top">
                         <div class="m_-2309046304354521016mj-column-per-100" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%">
                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                               <tbody>
                                  <tr>
                                     <td style="vertical-align:top;padding:0px">
                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                                           <tbody><tr>
                                              <td align="left" style="font-size:0px;padding:0px;word-break:break-word">
                                                 <div style="font-family:Trebuchet MS;font-size:13px;line-height:1;text-align:left;color:#000000">
                                                    <div style="width:85%;width:calc(46000% - 211600px);max-width:460px;min-width:308px;margin-left:auto;margin-right:auto;box-sizing:border-box;padding-left:16px;padding-right:16px;border-radius:2px;background-color:#ffffff;border-top-width:0px;border-top-style:solid;padding-top:20px;padding-bottom:20px;border-top-color:#069baa;margin-top:8px">
                                                       <div class="m_-2309046304354521016information-row" style="font-size:14px;line-height:1.5;width:100%;box-sizing:border-box;padding-left:9.3%">
                                                          <div class="m_-2309046304354521016label" style="color:#7b8199;display:inline-block;vertical-align:top;width:50%;width:calc((388.203px - 100%)*388.203);max-width:100%;min-width:30%;margin-bottom:15px">
                                                             Email
                                                          </div>
                                                          <div class="m_-2309046304354521016value" style="color:#515978;display:inline-block;max-width:70%">
                                                             <a href="mailto:dholesaurabhm@gmail.com" style="text-decoration:none;color:#528ff0" target="_blank">{{$data['order']->user_id}}</a>
                                                          </div>
                                                       </div>
                                                       <div class="m_-2309046304354521016information-row" style="font-size:14px;line-height:1.5;width:100%;box-sizing:border-box;padding-left:9.3%">
                                                          <div class="m_-2309046304354521016label" style="color:#7b8199;display:inline-block;vertical-align:top;width:50%;width:calc((388.203px - 100%)*388.203);max-width:100%;min-width:30%">
                                                             <span class="il">Mobile</span> Number
                                                          </div>
                                                          <div class="m_-2309046304354521016value" style="color:#515978;display:inline-block;max-width:70%">
                                                            {{$data['order']->mobile_no}}
                                                          </div>
                                                       </div>
                                                    </div>
                                                 </div>
                                              </td>
                                           </tr>
                                        </tbody></table>
                                     </td>
                                  </tr>
                               </tbody>
                            </table>
                         </div>
                      </td>
                   </tr>
                </tbody>
             </table>
          </div>
          <div style="Margin:0px auto;max-width:unset">
             <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%">
                <tbody>
                   <tr>
                      <td style="direction:ltr;font-size:0px;padding:0px;text-align:center;vertical-align:top">
                         <div class="m_-2309046304354521016mj-column-per-100" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%">
                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                               <tbody>
                                  <tr>
                                     <td style="vertical-align:top;padding:0px">
                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                                           <tbody><tr>
                                              <td align="left" style="font-size:0px;padding:0px;word-break:break-word">
                                                 <div style="font-family:Trebuchet MS;font-size:13px;line-height:1;text-align:left;color:#000000">
                                                    <div style="width:85%;width:calc(46000% - 211600px);max-width:460px;min-width:308px;margin-left:auto;margin-right:auto;box-sizing:border-box;padding-left:16px;padding-right:16px;border-radius:2px;background-color:#ffffff;padding-top:20px;padding-bottom:20px;margin-top:8px;border-top-width:2px;border-top-style:solid;padding-top:20px;padding-bottom:20px;border-top-color:#069baa">
                                                       <div style="text-align:center;color:#515978;font-size:14px;line-height:1.5">
                                                          For any order related queries, please reach out to Boleh.Store
                                                          <br>
                                                       </div>
                                                    </div>
                                                 </div>
                                              </td>
                                           </tr>
                                        </tbody></table>
                                     </td>
                                  </tr>
                               </tbody>
                            </table>
                         </div>
                      </td>
                   </tr>
                </tbody>
             </table>
          </div>
       </div>
       
       
       
       
       </div>
    </div>
 </div>