<?php

/*
 * Copyright 2011 Facebook
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

class JIRAMailListener extends PhabricatorEventListener {
  public function register() {
    $this->listen(PhabricatorEventType::TYPE_DIFFERENTIAL_WILLSENDMAIL);
  }

  public function handleEvent(PhabricatorEvent $event) {
    $mail = $event->getValue('mail');
    $subject = $mail->getSubject();
    $match = null;
    preg_match(
      '/([[:alnum:]]+-[[:digit:]]+)\s+\[jira\]/',
      $subject,
      $match
    );
    if (!$match) {
      // Not a JIRA mail, ignore it.
      return;
    }
    $jira_id = $match[1];
    $attachments = $mail->getAttachments();
    foreach ($attachments as $attachment) {
      $attachment->setFileName(
        $jira_id.'.'.$attachment->getFileName()
      );
    }
  }
}
