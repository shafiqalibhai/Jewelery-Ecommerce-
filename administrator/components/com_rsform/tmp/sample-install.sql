INSERT INTO `{PREFIX}rsform_components` (`ComponentId`, `FormId`, `ComponentTypeId`, `Order`, `Published`) VALUES(1, 1, 1, 2, 1)
INSERT INTO `{PREFIX}rsform_components` (`ComponentId`, `FormId`, `ComponentTypeId`, `Order`, `Published`) VALUES(2, 1, 10, 1, 1)
INSERT INTO `{PREFIX}rsform_components` (`ComponentId`, `FormId`, `ComponentTypeId`, `Order`, `Published`) VALUES(3, 1, 1, 3, 1)
INSERT INTO `{PREFIX}rsform_components` (`ComponentId`, `FormId`, `ComponentTypeId`, `Order`, `Published`) VALUES(4, 1, 3, 4, 1)
INSERT INTO `{PREFIX}rsform_components` (`ComponentId`, `FormId`, `ComponentTypeId`, `Order`, `Published`) VALUES(5, 1, 5, 5, 1)
INSERT INTO `{PREFIX}rsform_components` (`ComponentId`, `FormId`, `ComponentTypeId`, `Order`, `Published`) VALUES(6, 1, 4, 6, 1)
INSERT INTO `{PREFIX}rsform_components` (`ComponentId`, `FormId`, `ComponentTypeId`, `Order`, `Published`) VALUES(7, 1, 6, 7, 1)
INSERT INTO `{PREFIX}rsform_components` (`ComponentId`, `FormId`, `ComponentTypeId`, `Order`, `Published`) VALUES(8, 1, 13, 8, 1)
INSERT INTO `{PREFIX}rsform_components` (`ComponentId`, `FormId`, `ComponentTypeId`, `Order`, `Published`) VALUES(9, 1, 10, 9, 1)
INSERT INTO `{PREFIX}rsform_forms` VALUES(1,'RSformPro example','<table border="0">\n	<tr>\n		<td>{Header:caption}</td>\n		<td>{Header:body}<div class="formClr"/>{Header:validation}</td>\n		<td>{Header:description}</td>\n	</tr>\n	<tr>\n		<td>{FullName:caption} (*)</td>\n		<td>{FullName:body}<div class="formClr"/>{FullName:validation}</td>\n		<td>{FullName:description}</td>\n	</tr>\n	<tr>\n		<td>{Email:caption} (*)</td>\n		<td>{Email:body}<div class="formClr"/>{Email:validation}</td>\n		<td>{Email:description}</td>\n	</tr>\n	<tr>\n		<td>{CompanySize:caption} (*)</td>\n		<td>{CompanySize:body}<div class="formClr"/>{CompanySize:validation}</td>\n		<td>{CompanySize:description}</td>\n	</tr>\n	<tr>\n		<td>{Position:caption} (*)</td>\n		<td>{Position:body}<div class="formClr"/>{Position:validation}</td>\n		<td>{Position:description}</td>\n	</tr>\n	<tr>\n		<td>{ContactBy:caption}</td>\n		<td>{ContactBy:body}<div class="formClr"/>{ContactBy:validation}</td>\n		<td>{ContactBy:description}</td>\n	</tr>\n	<tr>\n		<td>{ContactWhen:caption} (*)</td>\n		<td>{ContactWhen:body}<div class="formClr"/>{ContactWhen:validation}</td>\n		<td>{ContactWhen:description}</td>\n	</tr>\n	<tr>\n		<td>{Submit:caption}</td>\n		<td>{Submit:body}<div class="formClr"/>{Submit:validation}</td>\n		<td>{Submit:description}</td>\n	</tr>\n	<tr>\n		<td>{Footer:caption}</td>\n		<td>{Footer:body}<div class="formClr"/>{Footer:validation}</td>\n		<td>{Footer:description}</td>\n	</tr>\n</table>\n','inline',1,'RSform!Pro example',1,'','','<p>Dear {FullName:value},</p><p> thank you for your submission. One of our staff members will contact you by  {ContactBy:value} as soon as possible.</p>','<p>Dear {FullName:value},</p><p>&nbsp;we received your&nbsp; contact request. Someone will get back to you by {ContactBy:value} soon. </p>','{Email:value}','','','your@email.com','','Your Company','Contact confirmation',1,0,'','<p>Customize this e-mail also. You will receive it as administrator.&nbsp;</p><p>{FullName:caption}:{FullName:value}<br /> 		                    			{Email:caption}:{Email:value}<strong></strong><br /> 		                    			{CompanySize:caption}:{CompanySize:value}<strong></strong><br /> 		                    			{Position:caption}:{Position:value}<strong></strong><br /> 		                    			{ContactBy:caption}:{ContactBy:value}<strong></strong><br /> 		                    			{ContactWhen:caption}:{ContactWhen:value}</p>','youradminemail@email.com','','','{Email:value}','','Your Company','Contact',1,'','','')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(1, 1, 'NAME', 'FullName')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(2, 1, 'CAPTION', 'Full Name')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(3, 1, 'REQUIRED', 'YES')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(4, 1, 'SIZE', '20')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(5, 1, 'MAXSIZE', '')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(6, 1, 'VALIDATIONRULE', 'none')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(7, 1, 'VALIDATIONMESSAGE', 'Please type your full name.')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(8, 1, 'ADDITIONALATTRIBUTES', '')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(9, 1, 'DEFAULTVALUE', '')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(10, 1, 'DESCRIPTION', '')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(11, 2, 'NAME', 'Header')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(12, 2, 'TEXT', '<b>This text describes the form. It is added using the Free Text component</b>. HTML code can be added directly here.')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(13, 3, 'NAME', 'Email')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(14, 3, 'CAPTION', 'E-mail')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(15, 3, 'REQUIRED', 'YES')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(16, 3, 'SIZE', '20')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(17, 3, 'MAXSIZE', '')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(18, 3, 'VALIDATIONRULE', 'email')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(19, 3, 'VALIDATIONMESSAGE', 'Invalid email address.')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(20, 3, 'ADDITIONALATTRIBUTES', '')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(21, 3, 'DEFAULTVALUE', '')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(22, 3, 'DESCRIPTION', '')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(23, 4, 'NAME', 'CompanySize')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(24, 4, 'CAPTION', 'Number of Employees')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(25, 4, 'SIZE', '')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(26, 4, 'MULTIPLE', 'NO')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(27, 4, 'ITEMS', '|Please Select[c]\n1-20\n21-50\n51-100\n>100|More than 100')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(28, 4, 'REQUIRED', 'YES')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(29, 4, 'ADDITIONALATTRIBUTES', '')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(30, 4, 'DESCRIPTION', '')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(31, 4, 'VALIDATIONMESSAGE', 'Please tell us how big is your company.')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(32, 5, 'NAME', 'Position')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(33, 5, 'CAPTION', 'Position')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(34, 5, 'ITEMS', 'CEO\nCFO\nCTO\nHR[c]')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(35, 5, 'FLOW', 'HORIZONTAL')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(36, 5, 'REQUIRED', 'YES')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(37, 5, 'ADDITIONALATTRIBUTES', '')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(38, 5, 'DESCRIPTION', '')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(39, 5, 'VALIDATIONMESSAGE', 'Please specify your position in the company')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(40, 6, 'NAME', 'ContactBy')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(41, 6, 'CAPTION', 'How should we contact you?')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(42, 6, 'ITEMS', 'E-mail[c]\nPhone\nNewsletter[c]\nMail')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(43, 6, 'FLOW', 'HORIZONTAL')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(44, 6, 'REQUIRED', 'NO')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(45, 6, 'ADDITIONALATTRIBUTES', '')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(46, 6, 'DESCRIPTION', '')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(47, 6, 'VALIDATIONMESSAGE', '')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(48, 7, 'NAME', 'ContactWhen')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(49, 7, 'CAPTION', 'When would you like to be contacted?')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(50, 7, 'REQUIRED', 'YES')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(51, 7, 'DATEFORMAT', 'dd.mm.yyyy')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(52, 7, 'CALENDARLAYOUT', 'POPUP')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(53, 7, 'ADDITIONALATTRIBUTES', '')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(54, 7, 'READONLY', 'YES')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(55, 7, 'POPUPLABEL', '...')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(56, 7, 'DESCRIPTION', '')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(57, 7, 'VALIDATIONMESSAGE', 'Please select a date when we should contact you.')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(58, 8, 'NAME', 'Submit')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(59, 8, 'LABEL', 'Submit')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(60, 8, 'CAPTION', '')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(61, 8, 'RESET', 'YES')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(62, 8, 'RESETLABEL', 'Reset')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(63, 8, 'ADDITIONALATTRIBUTES', '')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(64, 9, 'NAME', 'Footer')
INSERT INTO `{PREFIX}rsform_properties` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES(65, 9, 'TEXT', 'This form is an example. Please check our knowledgebase for articles related to how you should build your form. Articles are updated daily. <a href="http://www.rsjoomla.com/" target="_blank">http://www.rsjoomla.com/</a>')