# KnownFitness

Record "fitness" posts on your Known indieweb blog.  This will capture tracks in GPX or TCX (Garmin Training Center) format
as well as some basic metadata, then render the activity with a map (where appropriate) in your post.

Inspired by [indieweb.org/exercise](https://indieweb.org/exercise).

## Installation

  * Drop the `Fitness` folder into the `IdnoPlugins` folder of your Known installation.
  * Log into Known and click on Administration.
  * Click "enable" next to Fitness.

## Micropub to Fitness

  * name - becomes post 'title'
  * content - becomes post 'body'
  * private - becomes 'accessibility' for post owner

  __Need to patch IndiePub plugin for:__

  * track[]: - becomes post 'track[]' gpx/tcx track file
  * type (type of fitness post, e.g. 'trail running', 'resting heart rate')
  * stationary (true/false) - for exercise captured in a stationary position (indoor cycling, for instance)

  __Still evaluating__

  * StartTime (similar to h-event)
  * EndTime (similar to h-event)
  * Distance (experimented in with trip)
  
## Fitness Activity Type

This is the activity list from Garmin Connect which we hope to support, but the Indieweb page also suggests tracking basic stats like
resting heart rate, body weight, etc.  In addition there are TCX files which have multi-sport activities listed in them - some of the
new watches will track your entire triathlon, for instance, and record a "swim", "t1", "bike", "t2", "run" type of activity.

  * Uncategorized
  * Running
    *  Indoor Running
    *  Obstacle Running
    *  Street Running
    *  Track Running
    *  Trail Running
    *  Treadmill Running
    *  Virtual Running
  * Cycling
    *  BMX
    *  Cyclocross
    *  Downhill Biking
    *  Gravel/Unpaved Cycling
    *  Indoor Cycling
    *  Mountain Biking
    *  Recumbent Cycling
    *  Road Cycling
    *  Track Cycling
    *  Virtual Cycling
  * Fitness Equipment
    *  Elliptical
    *  Cardio
    *  Indoor Rowing
    *  Stair Stepper
    *  Strength Training
  * Hiking
  * Swimming
    *  Lap Swimming
    *  Open Water Swimming
  * Walking
    *  Casual Walking
    *  Speed Walking
  * Transition
    *  Bike to Run Transition
    *  Run to Bike Transition
    *  Swim to Bike Transition
  * Motorcycling
    *  ATV
    *  Motocross
  * Other
    *  Backcountry Skiing/Snowboarding
    *  Boating
    *  Cross Country Skiing
    *  Driving
    *  Floor Climbing
    *  Flying
    *  Golf
    *  Hang Gliding
    *  Horseback Riding
    *  Hunting/Fishing
    *  Inline Skating
    *  Mountaineering
    *  Paddling
    *  RC/Drone
    *  Resort Skiing/Snowboarding
    *  Rock Climbing
    *  Rowing
    *  Sailing
    *  Skate Skiing
    *  Skating
    *  Sky Diving
    *  Snowshoeing
    *  Snowmobiling
    *  Stand Up Paddleboarding
    *  Stopwatch
    *  Surfing
    *  Tennis
    *  Wakeboarding
    *  Whitewater Kayaking/Rafting
    *  Wind/Kite Surfing
    *  Wingsuit Flying
  * Diving
    *  Apnea
    *  Apnea Hunt
    *  Gauge Dive
    *  Multi-Gas Dive
    *  Single-Gas Dive
  * Yoga

## Uses

  * [leaflet-gpx](https://github.com/mpetazzoni/leaflet-gpx) :  This plugin, based on the work of [Pavel Shramov](http://github.com/shramov) and his [leaflet-plugins](http://github.com/shramov/leaflet-plugins), it allows for the analysis and parsing of a GPX track in order to display it as a Leaflet map layer. As it parses the GPX data, it will record information about the recorded track, including total time, moving time, total distance, elevation stats and heart-rate.
  * [Leaflet Elevation](https://github.com/MrMufflon/Leaflet.Elevation)

  * Originally forked from @klermor/KnownTracks - thanks for all your hard work!

