<?php

namespace InSided\Solution\Entity;

class Comment extends Message
{
    protected Post $parent;
}
