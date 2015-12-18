// Copyright (c) 2015, David Lall. All rights reserved. Use of this source code
// is governed by a BSD-style license that can be found in the LICENSE file.

// Add random generation, proper food types
import 'dart:html';
import 'dnd.dart';
import 'dart:math';

/// Dragging game where the food are dragged to their correct type.
void main() {
  // List of Draggables.
  var foodList = new List();

  // Create Draggables.
  foodList.add(new Draggable(querySelector('#draggableFruit'),
  avatarHandler: new AvatarHandler.clone()));
  foodList.add(new Draggable(querySelector('#draggableVegetable'),
  avatarHandler: new AvatarHandler.clone()));
  foodList.add(new Draggable(querySelector('#draggableJunk'),
  avatarHandler: new AvatarHandler.clone()));
  foodList.add(new Draggable(querySelector('#draggableFruit2'),
  avatarHandler: new AvatarHandler.clone()));
  foodList.add(new Draggable(querySelector('#draggableVegetable2'),
  avatarHandler: new AvatarHandler.clone()));

  // Use acceptor to accept fruits only.
  Dropzone dropzone1 = new Dropzone(querySelector('#dropzone-1'),
    acceptor: new Acceptor.draggables([foodList[0], foodList[3]]));

  // Use acceptor to accept vegetables only.
  Dropzone dropzone2 = new Dropzone(querySelector('#dropzone-2'),
    acceptor: new Acceptor.draggables([foodList[1], foodList[4]]));

  // Use acceptor to accept junk only.
  Dropzone dropzone3 = new Dropzone(querySelector('#dropzone-3'),
    acceptor: new Acceptor.draggables([foodList[2]]));

  // Remove the foods when dragged into the correct dropzone..
  dropzone1.onDrop.listen((DropzoneEvent event) {
    event.draggableElement.remove();
  });

  dropzone2.onDrop.listen((DropzoneEvent event) {
    event.draggableElement.remove();
  });

  dropzone3.onDrop.listen((DropzoneEvent event) {
    event.draggableElement.remove();
  });
}