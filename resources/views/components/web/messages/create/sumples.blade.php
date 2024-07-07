{{-- message_object --}}
<x-web.messages.create.message.text      id="sumple-message-messages-type-text"      index="{index}" :messages="array()" />
<x-web.messages.create.message.image     id="sumple-message-messages-type-image"     index="{index}" :messages="array()" />
<x-web.messages.create.message.template  id="sumple-message-messages-type-template"  index="{index}" :messages="array()" />

{{-- message_object_template --}}
<x-web.messages.create.template.buttons      id="sumple-message-messages-type-template-buttons"          index="{index}" :object="array()" />
<x-web.messages.create.template.confirm      id="sumple-message-messages-type-template-confirm"          index="{index}" :object="array()" />
{{-- <x-web.messages.create.template.carousel        id="sumple-message-messages-type-template-carousel"         index="{index}" :messages="array()" /> --}}
{{-- <x-web.messages.create.template.image_carousel  id="sumple-message-messages-type-template-image_carousel"   index="{index}" :messages="array()" /> --}}


<x-web.messages.create.action.message           id="sumple-default_action-type-message"                 area="default_action"           index="{index}"                                         :action="array()" />
<x-web.messages.create.action.postback          id="sumple-default_action-type-postback"                area="default_action"           index="{index}"                                         :action="array()" />
<x-web.messages.create.action.uri               id="sumple-default_action-type-uri"                     area="default_action"           index="{index}"                                         :action="array()" />
<x-web.messages.create.action.datetimepicker    id="sumple-default_action-type-datetimepicker"          area="default_action"           index="{index}"                                         :action="array()" />
<x-web.messages.create.action.richmenuswitch    id="sumple-default_action-type-richmenuswitch"          area="default_action"           index="{index}"                                         :action="array()" />
<x-web.messages.create.action.clipboard         id="sumple-default_action-type-clipboard"               area="default_action"           index="{index}"                                         :action="array()" />

<x-web.messages.create.action.message           id="sumple-actions-type-message"                        area="actions"                  index="{index}"                     choice="{choice}"   :action="array()" />
<x-web.messages.create.action.postback          id="sumple-actions-type-postback"                       area="actions"                  index="{index}"                     choice="{choice}"   :action="array()" />
<x-web.messages.create.action.uri               id="sumple-actions-type-uri"                            area="actions"                  index="{index}"                     choice="{choice}"   :action="array()" />
<x-web.messages.create.action.datetimepicker    id="sumple-actions-type-datetimepicker"                 area="actions"                  index="{index}"                     choice="{choice}"   :action="array()" />
<x-web.messages.create.action.richmenuswitch    id="sumple-actions-type-richmenuswitch"                 area="actions"                  index="{index}"                     choice="{choice}"   :action="array()" />
<x-web.messages.create.action.clipboard         id="sumple-actions-type-clipboard"                      area="actions"                  index="{index}"                     choice="{choice}"   :action="array()" />

<x-web.messages.create.action.message           id="sumple-column_default_action-type-message"          area="column_default_action"    index="{index}" column="{column}"                       :action="array()" />
<x-web.messages.create.action.postback          id="sumple-column_default_action-type-postback"         area="column_default_action"    index="{index}" column="{column}"                       :action="array()" />
<x-web.messages.create.action.uri               id="sumple-column_default_action-type-uri"              area="column_default_action"    index="{index}" column="{column}"                       :action="array()" />
<x-web.messages.create.action.datetimepicker    id="sumple-column_default_action-type-datetimepicker"   area="column_default_action"    index="{index}" column="{column}"                       :action="array()" />
<x-web.messages.create.action.richmenuswitch    id="sumple-column_default_action-type-richmenuswitch"   area="column_default_action"    index="{index}" column="{column}"                       :action="array()" />
<x-web.messages.create.action.clipboard         id="sumple-column_default_action-type-clipboard"        area="column_default_action"    index="{index}" column="{column}"                       :action="array()" />

<x-web.messages.create.action.postback          id="sumple-column_action-type-postback"                 area="column_action"            index="{index}" column="{column}"                       :action="array()" />
<x-web.messages.create.action.message           id="sumple-column_action-type-message"                  area="column_action"            index="{index}" column="{column}"                       :action="array()" />
<x-web.messages.create.action.uri               id="sumple-column_action-type-uri"                      area="column_action"            index="{index}" column="{column}"                       :action="array()" />
<x-web.messages.create.action.datetimepicker    id="sumple-column_action-type-datetimepicker"           area="column_action"            index="{index}" column="{column}"                       :action="array()" />
<x-web.messages.create.action.richmenuswitch    id="sumple-column_action-type-richmenuswitch"           area="column_action"            index="{index}" column="{column}"                       :action="array()" />
<x-web.messages.create.action.clipboard         id="sumple-column_action-type-clipboard"                area="column_action"            index="{index}" column="{column}"                       :action="array()" />

<x-web.messages.create.action.postback          id="sumple-column_actions-type-postback"                area="column_actions"           index="{index}" column="{column}"    choice="{choice}"  :action="array()" />
<x-web.messages.create.action.message           id="sumple-column_actions-type-message"                 area="column_actions"           index="{index}" column="{column}"    choice="{choice}"  :action="array()" />
<x-web.messages.create.action.uri               id="sumple-column_actions-type-uri"                     area="column_actions"           index="{index}" column="{column}"    choice="{choice}"  :action="array()" />
<x-web.messages.create.action.datetimepicker    id="sumple-column_actions-type-datetimepicker"          area="column_actions"           index="{index}" column="{column}"    choice="{choice}"  :action="array()" />
<x-web.messages.create.action.richmenuswitch    id="sumple-column_actions-type-richmenuswitch"          area="column_actions"           index="{index}" column="{column}"    choice="{choice}"  :action="array()" />
<x-web.messages.create.action.clipboard         id="sumple-column_actions-type-clipboard"               area="column_actions"           index="{index}" column="{column}"    choice="{choice}"  :action="array()" />