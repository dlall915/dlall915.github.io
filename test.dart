// Copyright (c) 2015, David Lall. All rights reserved. Use of this source code
// is governed by a BSD-style license that can be found in the LICENSE file.
//
// Test version of the practice page, no color indicator to let users know  if they are right or wrong and
// all drop zones will accept all the draggables.
//

import 'dart:html';
import 'dnd.dart';

final int totalDraggables = 5;
double totalCorrect = 0.0;
double droppedCounter = 0.0;

void updateScore() {
  querySelector('#results').text = 'Score: ' + ((totalCorrect)).toString() + ' out of ' + totalDraggables.toString() +
  ' correct!';
  scoreMessage();
}

void scoreMessage() {
  if (droppedCounter == 5 && totalCorrect == 5) {
    querySelector('#results').text = 'Score: ' + ((totalCorrect)).toString() + ' out of ' + totalDraggables.toString() +
    ' correct! Excellent, all correct!';
  }
  else {}
}

void main() {
  // List of Draggables.
  var foodList = new List();

  // Create Draggables and add them to the list.
  foodList.add(new Draggable(querySelector('#draggableFruit'),
  avatarHandler: new AvatarHandler.clone()));
  foodList.add(new Draggable(querySelector('#draggableVegetable'),
  avatarHandler: new AvatarHandler.clone()));
  foodList.add(new Draggable(querySelector('#draggableJunk'),
  avatarHandler: new AvatarHandler.clone()));
  foodList.add(new Draggable(querySelector('#draggableFruit2'),
  avatarHandler: new AvatarHandler.clone()));
  foodList.add(new Draggable(querySelector('#draggableFruit3'),
  avatarHandler: new AvatarHandler.clone()));

  // Draggables will still disappear even though the drop zones only accept certain Draggables.
  // Use acceptor to accept fruits only.
  Dropzone dropzone1 = new Dropzone(querySelector('#dropzone-1'),
  acceptor: new Acceptor.draggables([foodList[0], foodList[3], foodList[4]]));

  // Use acceptor to accept vegetables only.
  Dropzone dropzone2 = new Dropzone(querySelector('#dropzone-2'),
  acceptor: new Acceptor.draggables([foodList[1]]));

  // Use acceptor to accept junk only.
  Dropzone dropzone3 = new Dropzone(querySelector('#dropzone-3'),
  acceptor: new Acceptor.draggables([foodList[2]]));

  // Remove the foods when dragged into the correct dropzone.
  dropzone1.onDrop.listen((DropzoneEvent event) {
    event.draggableElement.remove();
    totalCorrect+= 1;
    droppedCounter+= 1;
    updateScore();
  });

  dropzone2.onDrop.listen((DropzoneEvent event) {
    event.draggableElement.remove();
    totalCorrect+= 1;
    droppedCounter+= 1;
    updateScore();
  });

  dropzone3.onDrop.listen((DropzoneEvent event) {
    event.draggableElement.remove();
    totalCorrect+= 1;
    droppedCounter+= 1;
    updateScore();
  });

}